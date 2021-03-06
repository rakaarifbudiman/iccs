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

class AuthRequest extends FormRequest
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
            'hashkey'  => ['required', 'string','min:6'],   
            'key'  => ['required', 'numeric','min:6'],        
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
        $this->ensureIsNotRateLimited();        
        if (! Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey(), $second = 300 );

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }                      
            $user = User::find(auth::user()->id);
            $user->last_seen = \Carbon\Carbon::now();        
            $user->save();
            
            RateLimiter::clear($this->throttleKey());     
        
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
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => floor($seconds / 60),
                'lastseconds'=>fmod($seconds,60)
                
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
            'hashkey.required' => 'Failed...You are not authorize',                 
        ];
    }

}
