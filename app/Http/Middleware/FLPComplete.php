<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\FLP\FLPParent;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;

class FLPComplete
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
        // $decrypted = Crypt::decryptString($id);
        //get data flp
        $flp = FLPParent::find(42);             
                
        //get data action
        $flpactions = DB::table('flpactions')
        ->where('code',$flp->code)
        ->get();        
        
        //check completeness 
        if (!$flp->datesign_inisiator  || !$flp->datesign_leader){
            $inisiatorcomplete="Incomplete";
        }else{
            $inisiatorcomplete="Complete";
        }        
        $count = $flpactions->count();         
        $countactionincomplete = $flpactions->where('signdate_action',null)->count();       
        
        
        if($count>0 && $countactionincomplete==0){
            $actioncomplete = "Complete";            
        }else{
            $actioncomplete = "Incomplete";
        }
        
        if($inisiatorcomplete=="Complete" && $actioncomplete == "Complete"){
            return $next($request);
        }else{
            return back()->with('error','FLP still incomplete !');
        }


        
    }
}
