<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->active == 1) {
            if (Hash::check("123456", Auth::user()->password) || 
                Hash::check("P@ssw0rd", Auth::user()->password) || 
                Hash::check("P@ssw0rd1", Auth::user()->password) ||
                Hash::check("P@ssw0rd12", Auth::user()->password) ||
                Hash::check("P@ssw0rd123", Auth::user()->password) ||
                Hash::check("P@ssw0rd1234", Auth::user()->password) ||
                Hash::check("P@ssw0rd12345", Auth::user()->password) ||
                Hash::check("P@ssw0rd123456", Auth::user()->password)) {
                return back()->with('error','Your account has default password. Please change your password to continue transaction');
                
            }else{
                return $next($request);
            }                
       }
       return back()->with('error','Your Account has not been activated...Please Contact Quality Compliance Team');
    }
}
