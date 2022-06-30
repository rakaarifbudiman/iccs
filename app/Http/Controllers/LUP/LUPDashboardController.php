<?php

namespace App\Http\Controllers\LUP;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LUPDashboardController extends Controller
{
    public function querylup_leader()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('leader',Auth::user()->username)    
                ->where('datesign_leader',null)                  
                ->orderBy('lup_parents.id','desc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

    public function querylup_regulatoryreview()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('regulatory_reviewer',Auth::user()->username)             
                ->where('datesubmit_regulatory_approver',null)               
                ->orderBy('lup_parents.id','desc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

    public function querylup_regulatoryapproval()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('regulatory_approver',Auth::user()->username)             
                ->where('datesign_regulatory_approver',null)               
                ->orderBy('lup_parents.id','desc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

    public function querylup_relateddepartments()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('related_departments', 'lup_parents.code', '=', 'related_departments.code')   
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')                  
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','related_departments.*','lup_actions.*')  
                ->where('related_departments.username',Auth::user()->username)    
                ->where('related_departments.signdate',null)    
                ->where('lup_parents.lupstatus','ON REVIEW')              
                ->orderBy('lup_parents.id','desc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

    public function querylup_myactionopen()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lup_actions.pic_action',Auth::user()->username)  
                ->where('lup_actions.actionstatus','OPEN')                
                ->where('lup_actions.evidence_filename',null)            
                ->whereDate('lup_actions.duedate_action','>=',now()->addDays(8))
                ->orderBy('duedate_action','asc')                  
                ->orderBy('lup_parents.id','desc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);                
    }
    public function querylup_mydeptactionopen()
    {
        $lupparents = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->leftjoin('users', 'users.username', '=', 'lup_actions.pic_action')
            ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code', 'lup_actions.*','users.*','users.department as pic_dept')
            ->where('users.department',Auth::user()->department)
            ->whereNotNull('nolup')            
            ->where('duedate_status',1)
            ->where('deletion_flag',0)
            ->whereNull('dateapproved_evidence')
            ->whereDate('duedate_action','>=',now()->addDays(8))
            ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);                
    }

    public function querylup_myactionoverdue()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lup_actions.pic_action',Auth::user()->username)  
                ->where('lup_actions.actionstatus','OPEN')                 
                ->where('lup_actions.evidence_filename',null)            
                ->whereDate('lup_actions.duedate_action','<',now()->addDays(8))
                ->orderBy('duedate_action','asc')            
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);       
    }
    public function querylup_mydeptactionoverdue()
    {
        $lupparents = DB::table('lup_parents')
                ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->leftjoin('users', 'users.username', '=', 'lup_actions.pic_action')
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code', 'lup_actions.*','users.*','users.department as pic_dept',)
                ->where('users.department',Auth::user()->department)
                ->whereNotNull('nolup')                
                ->where('duedate_status',1)
                ->where('deletion_flag',0)
                ->whereNull('dateapproved_evidence')
                ->whereDate('duedate_action','<',now()->addDays(8))          
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);       
    }
    public function querylup_myactionextension()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lup_actions.pic_action',Auth::user()->username)  
                ->where('lup_actions.actionstatus','LIKE','ON EXTENSION%')                            
                ->orderBy('duedate_action','asc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

    public function querylup_myactioncancel()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lup_actions.pic_action',Auth::user()->username)  
                ->where('lup_actions.actionstatus','ON CANCEL')                            
                ->orderBy('duedate_action','asc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }
       

    public function querylup_signaction()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lup_actions.pic_action',Auth::user()->username)  
                ->where('lup_actions.signdate_action',null)            
                ->where('lup_parents.lupstatus','APPROVED')             
                ->orderBy('duedate_action','asc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);               
    }

    public function querylup_myonprocess()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('inisiator',Auth::user()->username)
                    ->where('lupstatus','CREATE')
                    ->orWhere(function($query) {
                        $query->where('inisiator',Auth::user()->username)
                        ->where('lupstatus','ON PROCESS');       
                    })
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_myoncancel()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('inisiator',Auth::user()->username)
                ->where('lupstatus','ON CANCEL')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_onprocess()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','ON PROCESS')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_onclosing()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','ON CLOSING')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_oncancel()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','ON CANCEL')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_onclosingapproval()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','ON CLOSING APPROVAL')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_oncancelapproval()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','ON CANCEL APPROVAL')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_onreview()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','ON REVIEW')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_onapproval()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','ON APPROVAL')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_onapproved()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')  
                ->where('lupstatus','APPROVED')                    
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);             
    }

    public function querylup_actionoverdue()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')                   
                ->where('lup_actions.actionstatus','OPEN')               
                ->where('lup_actions.evidence_filename',null)            
                ->whereDate('lup_actions.duedate_action','<',now()->addDays(8))
                ->orderBy('duedate_action','asc')            
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);       
    }

    public function querylup_actionextension()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')                
                ->where('lup_actions.actionstatus','ON EXTENSION')                            
                ->orderBy('duedate_action','asc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

    public function querylup_actionclosing()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')                
                ->where('lup_actions.actionstatus','ON CLOSING')                           
                ->orderBy('duedate_action','asc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

    public function querylup_actionextensionapproval()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')                 
                ->where('lup_actions.actionstatus','ON EXTENSION APPROVAL')                            
                ->orderBy('duedate_action','asc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }
    public function querylup_actioncancel()
    {
        $lupparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')                 
                ->where('lup_actions.actionstatus','ON CANCEL')                            
                ->orderBy('duedate_action','asc')
                ->get();                          

        $statusaction=lupallstatusactions( $lupparents);        
        
        return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,        
        ]);
    }

}
