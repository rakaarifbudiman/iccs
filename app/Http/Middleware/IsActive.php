<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

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
        if(Auth::check()==false) {
            return redirect('/')->with('warning','Please Login First');
        }
            $date1 = strtotime(Auth::user()->password_change_at);
            $date2 = strtotime(\Carbon\Carbon::now());
            $diff = round(($date2-$date1)/(60),0);            
            $getdiff = round($diff/40320, 1); 
        if($getdiff >3){
            return redirect('/users-profile/'.Crypt::encryptString(Auth::user()->id).'/edit/changepassword')->with('error','Your password has expired. Please change your password to continue transaction');
        }                           

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
