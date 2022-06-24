<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request,$token)
    {        
        $cekuser = DB::Table('password_resets')->where('token',$token)->first();    
        if(!$cekuser){            
            return redirect('/forgot-password')->with('error','Failed...This Link has Expired !!');
        }
        $cektime = (strtotime(\Carbon\Carbon::now()) - strtotime($cekuser->created_at))/60 ;       
        
        $request = $cekuser->email;
        if ($cektime < env('SESSION_LIFETIME')){
        }else{
            $deltoken = DB::table('password_resets')->where('token',$token)->delete();
            return redirect('/forgot-password')->with('error','Failed...This Link has Expired !!');
        }
        return view('auth.reset-password', ['request' => $request,'token'=>$token]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedcase()
                ->numbers()
                ->symbols()
                ->uncompromised()
                ],
        ]);        
        $request->only('email', 'password', 'password_confirmation', 'token');
        $iduser = User::where('email',$request->email)->first();
        $cekuser = DB::Table('users')->where('email',$request->email);
        $listuser=$cekuser->implode('username',', ');           
        $deltoken = DB::table('password_resets')->where('token',$request->token)->delete();
        
        if ($cekuser->count() >1){
            return back()->with('error','You cannot use password reset because there are '.$cekuser->count().' users that using same email ('.$listuser.')');
        }
        $user = User::find($iduser->id); 
        $user->password = Hash::make($request->password);             
        $user->last_seen = null;                               
        $user->save();  
        
        return redirect('/login')->with('success','Password has been changed!');   
    
      }
}
