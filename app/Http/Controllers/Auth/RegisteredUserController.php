<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\Auth\RequestUserActive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\Auth\RegisterRequest;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([    
            'username' => str::lower($request->username),        
            'name' => $request->name,
            'email' => $request->email,
            'level' => 1,
            'password' => Hash::make($request->password),
            'unid' => Str::replace('/','',Str::random(80)),
        ]);

        $emailreviewers = DB::table('users')
            ->where('level',2)
            ->where('active',1)->get('email');  
        $emailto = $request->email;
        foreach($emailreviewers as $email){
            $emailcc[]=$email->email;
        }
        
        //Send Notif to Reviewer
        
        $mailData = [
            'user' => $request->username
        ];             
        Mail::to($emailto)
        ->cc(env('MAIL_TO_TESTING'))  
        ->send(new RequestUserActive($mailData));

        return redirect('/login')->with('success','Register success... Please check your email...');        
    }
}
