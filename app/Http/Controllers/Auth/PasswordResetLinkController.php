<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\Auth\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        return view('auth.forgot-password');
    }

    /*** Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.        
        $cekuser = DB::Table('users')->where('email',$request->email);
        $listuser=$cekuser->implode('username',', ');       
        
        if ($cekuser->count() <1){
            return back()->with('error','Email not found ');
        }        
        if ($cekuser->count() >1){
            return back()->with('error','You cannot use password reset because there are '.$cekuser->count().' users that using same email ('.$listuser.')');
        }
        $token = Str::replace('/','',Str::random(80));
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => now()
          ]);
        $url = '<a href="'.env('APP_URL').'/reset-password/'.$token.'" style="
            background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
            inline-block;text-decoration: none;"'.'>Reset Password</a>'; 
        
        $mailData = [
            'url' => $url,            
            'name'=>$cekuser->first()->name,
            'email'=>$cekuser->first()->email,
        ];   
        $emailto = $request->email;
        Mail::to($emailto)            
        ->send(new ResetPassword($mailData));
        
        $iduser = DB::table('users')->where('email',$request->email)->first()->id;
        
        $user = User::find($iduser);       
        
        $user->last_seen = \Carbon\Carbon::now();                            
        
        $user->save();  
        return back()->with('success','Email Sent...');
        
    }
}
