<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;

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
        $user = USER::where('username',$this->input('username'))->first();
        $executed = RateLimiter::attempt(
            'login:'.$user->username,
            $perMinute = 3,
            function() {                   
                }
        );    

            if (! $executed) {            
                $user->active = 0;
                $user->save();
                $seconds = RateLimiter::availableIn('login:'.$user->username);
                throw ValidationException::withMessages([
                    'username' => trans('auth.throttle', [
                        'seconds' => $seconds,
                        //'minutes' => ceil($seconds / 60),
                    ]),
                ]);                     
            }     
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('username')).'|'.$this->ip();
    }
    public function messages()
    {
        return [
            'captcha.captcha' => 'Incorrect Captcha...',      
            'auth.throttle' => 'Too many login attempts. Your account has been deactivated. Please Call ICCS Admin & Please try again in :seconds seconds.',           
        ];
    }
}
