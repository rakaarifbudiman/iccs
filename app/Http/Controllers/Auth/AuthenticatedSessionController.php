<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\Models\User;
use App\Mail\Auth\MFA;
use App\Mail\DemoMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Auth\AuthRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{    
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }      

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {                   
        $user = USER::where('username',Str::lower($request->username))->first();        
        if(!$user){
            return back()->with('error','Failed...Your credentials does not match with database');     
        }
        $request->authenticate();
        if ($user->active==0){         
            return back()->with('error','Failed...Your account has not been activated, Please Call Quality Compliance Team');            
        }
        if (Hash::check($request->password, $user->password) AND $user) {
                        
            $username = $request->username;
            $password = Crypt::encryptString($request->password);
            $key = random_int(100000, 999999); 
            $hashkey = Hash::make($key);
            $token = Str::replace('/','',Str::random(80));            
            DB::table('mfalogins')->insert([
                'username' => $user->username, 
                'token' => $token, 
                'key' => $hashkey,
                'created_at' => now()
            ]);          
            
            $mailData = [                          
                'name'=>$user->name,
                'email'=>$user->email,
                'key'=>$key,
            ];   
            $emailto = $user->email;
            Mail::to($emailto)
            ->cc($emailto)            
            ->send(new MFA($mailData));    
            
            RateLimiter::clear('login:'.$user->username);  
            return redirect('/login/'.$token.'/'.$password.'/authenticated')->with('success','Please check your email to get a key');            
        }       
        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
    ]);   
    }

    public function mfa($token,$password)
    {
        $user = DB::Table('mfalogins')->where('token',$token)->first();
        if(!$user){            
            return redirect('/login')->with('error','Failed...This Link has Expired !!');
        }
        
        $password = Crypt::decryptString($password);        
        
        $cektime = (strtotime(\Carbon\Carbon::now()) - strtotime($user->created_at))/60 ;        
        if ($cektime < 5){
        }else{
            $deltoken = DB::table('mfalogins')->where('token',$token)->delete();
            return redirect('/login')->with('error','Failed...This Link has Expired !!');
        }
        
        return view('auth.mfa',[
            'token'=>$token,
            'username'=>$user->username,
            'password'=>$password,
            'hashkey'=>$user->key
        ]);
    }  
    

    public function mfastore(AuthRequest $request,$token)
    {
        $user = DB::Table('mfalogins')->where('token',$token)->first();      
        
        if (Hash::check($request->key, $user->key)) {           
            $request->authenticate();        
            $request->session()->regenerate();              
            DB::table('logins')->insert([
                'username' => Auth::user()->username, 
                'ip' => $request->ip(), 
                'user-agent' => $request->header('User-Agent'),
                'created_at' => now()
            ]);     
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            return back()->with('error','Failed...Your key does not match with database');
        }        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $id=auth::user()->id;
        $user = User::find($id);
        $user->last_seen = null;        
        $user->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect('/login')->with('info','Please re-login');
        
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('math')]);
    }
}
