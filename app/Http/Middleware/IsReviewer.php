<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;

class IsReviewer
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
        $date1 = strtotime(Auth::user()->password_change_at);
            $date2 = strtotime(\Carbon\Carbon::now());
            $diff = round(($date2-$date1)/(60),0);            
            $getdiff = round($diff/40320, 1); 
            
        if($getdiff >3){
            return redirect('/users-profile/'.Crypt::encryptString(Auth::user()->id).'/edit/changepassword')->with('error','Your password has expired. Please change your password to continue transaction');
        }           
        
        if (Auth::user() &&  (Auth::user()->level > 1) && (Auth::user()->active == 1)) {
            return $next($request);
       }

       return back()->with('error','Restricted Access... Only Reviewer & Approver can access');
    }
}
