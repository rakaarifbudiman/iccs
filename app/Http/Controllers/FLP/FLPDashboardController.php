<?php

namespace App\Http\Controllers\FLP;

use Mail;
use App\Models\User;
use App\Models\FLP\FLPAction;
use App\Models\FLP\FLPParent;
use App\Models\FLP\FLPFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\FLP\FLPNotifToLeader;
use App\Mail\FLP\FLPNotifToApprover;
use App\Mail\FLP\FLPNotifToReviewer;
use App\Mail\FLP\FLPNotifHasApproved;
Use IlluminateDatabase\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class FLPDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function queryflp_leader()
    {
        $date1 = strtotime(\Carbon\Carbon::now());
        $flpparents = DB::table('flpparents')
            ->leftjoin('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*','flpparents.id as flp_id', 'flpparents.code as flp_code','flpactions.*')   
            ->where('leader',Auth::user()->username)                  
            ->orderBy('flpparents.id','desc')
            ->get();
        
        $count=$flpparents->count();
        for ($i=0; $i < $count ; $i++) {
            // get status action
            
                $date2 = strtotime($flpparents[$i]->duedate_action);
                $datediff =round(($date2-$date1)/(60*60*24),0);
                
                if($datediff<8 AND !$flpparents[$i]->dateapproved_evidence AND $flpparents[$i]->noflp){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction []= $flpparents[$i]->actionstatus;
                }
            
              
        }
        if(!$count){
            $statusaction="";
        }
	    return view('flp.masterlistflp', ['flpparents' => $flpparents,
        'statusaction'=>$statusaction
        ]);
    }
    public function queryflp_actionopen()
    {
        $date1 = strtotime(\Carbon\Carbon::now());
        
        $flpparents = DB::table('flpparents')
            ->leftjoin('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*','flpparents.id as flp_id', 'flpparents.code as flp_code','flpactions.*')   
            ->where('flpactions.pic_action',Auth::user()->username)  
            ->where('flpactions.actionstatus','OPEN')  
            ->where('flpparents.flpstatus','OPEN') 
            ->where('flpactions.evidence_filename',null)            
            ->whereDate('flpactions.duedate_action','>=',now()->addDays(8))
            ->orderBy('duedate_action','asc')
            ->get();
        
        $count=$flpparents->count();
        for ($i=0; $i < $count ; $i++) {
            // get status action
            
                $date2 = strtotime($flpparents[$i]->duedate_action);
                $datediff =round(($date2-$date1)/(60*60*24),0);
                
                if($datediff<8 AND !$flpparents[$i]->dateapproved_evidence AND $flpparents[$i]->noflp){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction []= $flpparents[$i]->actionstatus;
                }           
              
        }
        if(!$count){
            $statusaction="";
        }
	    return view('flp.masterlistflp', ['flpparents' => $flpparents,
        'statusaction'=>$statusaction
        ]);
    }

    public function queryflp_actionoverdue()
    {
        $date1 = strtotime(\Carbon\Carbon::now());
        
        $flpparents = DB::table('flpparents')
            ->leftjoin('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*','flpparents.id as flp_id', 'flpparents.code as flp_code','flpactions.*')   
            ->where('flpactions.pic_action',Auth::user()->username)  
            ->where('flpactions.actionstatus','OPEN')  
            ->where('flpparents.flpstatus','OPEN') 
            ->where('flpactions.evidence_filename',null)            
            ->whereDate('flpactions.duedate_action','<',now()->addDays(8))
            ->orderBy('duedate_action','asc')
            ->get();
        
        $count=$flpparents->count();
        for ($i=0; $i < $count ; $i++) {
            // get status action
            
                $date2 = strtotime($flpparents[$i]->duedate_action);
                $datediff =round(($date2-$date1)/(60*60*24),0);
                
                if($datediff<8 AND !$flpparents[$i]->dateapproved_evidence AND $flpparents[$i]->noflp){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction []= $flpparents[$i]->actionstatus;
                }           
              
        }
        if(!$count){
            $statusaction="";
        }
	    return view('flp.masterlistflp', ['flpparents' => $flpparents,
        'statusaction'=>$statusaction
        ]);
    }


    public function queryflp_actionextension()
    {
        $date1 = strtotime(\Carbon\Carbon::now());
        
        $flpparents = DB::table('flpparents')
            ->leftjoin('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*','flpparents.id as flp_id', 'flpparents.code as flp_code','flpactions.*')   
            ->where('flpactions.pic_action',Auth::user()->username)  
            ->where('flpactions.actionstatus','ON EXTENSION')  
            ->where('flpparents.flpstatus','OPEN')             
            ->orderBy('duedate_action','asc')
            ->get();
        
        $count=$flpparents->count();
        for ($i=0; $i < $count ; $i++) {
            // get status action
            
                $date2 = strtotime($flpparents[$i]->duedate_action);
                $datediff =round(($date2-$date1)/(60*60*24),0);
                
                if($datediff<8 AND !$flpparents[$i]->dateapproved_evidence AND $flpparents[$i]->noflp){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction []= $flpparents[$i]->actionstatus;
                }           
              
        }
        if(!$count){
            $statusaction="";
        }
	    return view('flp.masterlistflp', ['flpparents' => $flpparents,
        'statusaction'=>$statusaction
        ]);
    }

    public function queryflp_signaction()
    {
        $date1 = strtotime(\Carbon\Carbon::now());
        
        $flpparents = DB::table('flpparents')
            ->leftjoin('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*','flpparents.id as flp_id', 'flpparents.code as flp_code','flpactions.*')   
            ->where('flpactions.pic_action',Auth::user()->username)  
            ->where('flpactions.signdate_action',null)            
            ->where('flpparents.flpstatus','ON PROCESS')             
            ->orderBy('duedate_action','asc')
            ->get();
        
        $count=$flpparents->count();
        for ($i=0; $i < $count ; $i++) {
            // get status action
            
                $date2 = strtotime($flpparents[$i]->duedate_action);
                $datediff =round(($date2-$date1)/(60*60*24),0);
                
                if($datediff<8 AND !$flpparents[$i]->dateapproved_evidence AND $flpparents[$i]->noflp){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction []= $flpparents[$i]->actionstatus;
                }           
              
        }
        if(!$count){
            $statusaction="";
        }
	    return view('flp.masterlistflp', ['flpparents' => $flpparents,
        'statusaction'=>$statusaction
        ]);
    }

    public function queryflp_onprocess()
    {
        $date1 = strtotime(\Carbon\Carbon::now());
        
        $flpparents = DB::table('flpparents')
                    ->leftjoin('flpactions', 'flpparents.code', '=', 'flpactions.code')            
                    ->select('flpparents.*','flpparents.id as flp_id', 'flpparents.code as flp_code','flpactions.*')             
                    ->where('inisiator',Auth::user()->username)
                    ->where('flpstatus','CREATE')
                    ->orWhere(function($query) {
                        $query->where('inisiator',Auth::user()->username)
                        ->where('flpstatus','ON PROCESS');       
                    })->get();
            
        
        $count=$flpparents->count();
        for ($i=0; $i < $count ; $i++) {
            // get status action
            
                $date2 = strtotime($flpparents[$i]->duedate_action);
                $datediff =round(($date2-$date1)/(60*60*24),0);
                
                if($datediff<8 AND !$flpparents[$i]->dateapproved_evidence AND $flpparents[$i]->noflp){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction []= $flpparents[$i]->actionstatus;
                }           
              
        }
        if(!$count){
            $statusaction="";
        }
	    return view('flp.masterlistflp', ['flpparents' => $flpparents,
        'statusaction'=>$statusaction
        ]);
    }
}
