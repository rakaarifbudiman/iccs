<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use App\Mail\Auth\NotifLoginAttempts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Mail;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string','min:8'],
            'captcha' => 'required|captcha'
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {        
        $user = USER::where('username',Str::lower($this->input('username')))->first();
        
        $executed = RateLimiter::attempt(
            'login:'.$user->username,
            $perMinutes= 3,
            function() {                   
                },$decaySeconds = 300
        );    

            if (! $executed) {            
                $user->active = 0;
                $user->save();    
                DB::table('errorlogins')->insert([
                    'username' => $user->username, 
                    'ip' => $this->ip(), 
                    'user-agent' => $this->header('User-Agent'),
                    'created_at' => now()
                ]);   
                
                $mailData = [                          
                    'name'=>$user->name,
                    'username' => $user->username, 
                    'ip' => $this->ip(), 
                    'user-agent' => $this->header('User-Agent'),                    
                ];   
                $emailto = $user->email;
                Mail::to(env('MAIL_TO_TESTING'))
                ->cc($emailto)             
                ->send(new NotifLoginAttempts($mailData));    
                
                $seconds = RateLimiter::availableIn('login:'.$user->username);
                throw ValidationException::withMessages([
                    'username' => trans('auth.throttle', [
                        'seconds' => $seconds,
                        'minutes' => floor($seconds / 60),
                        'lastseconds'=>fmod($seconds,60)
                    ]),
                ]);                     
            }     
    }

    public function messages()
    {
        return [
            'captcha.captcha' => 'Incorrect Captcha...',
            
        ];
    }
}
