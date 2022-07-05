<?php

namespace App\Http\Controllers\ICCS;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FLP\FLPParent;
use App\Models\LUP\LUPAction;
use App\Models\LUP\LUPParent;
use App\Models\RDMS\MasterPart;
use illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
Use IlluminateDatabase\Eloquent\ModelNotFoundException;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //lup        
        $quotes = Inspiring::quote();
        $luponprocess = LUPParent::OnStatus('ON PROCESS')->count();
        $luponreview = LUPParent::OnStatus('ON REVIEW')->count();
        $luponapproval = LUPParent::OnStatus('ON APPROVAL')->count();
        $luponcancel = LUPParent::OnStatus('ON CANCEL')->count();
        $luponclosing = LUPParent::OnStatus('ON CLOSING')->count();
        $luponcancelapproval = LUPParent::OnStatus('ON CANCEL APPROVAL')->count();
        $luponclosingapproval = LUPParent::OnStatus('ON CLOSING APPROVAL')->count();
        $luponapproved = LUPParent::OnStatus('APPROVED')->count();        
        $lupactionoverdue = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->select('lup_parents.*', 'lup_actions.*')            
            ->whereNotNull('nolup')            
            ->where('actionstatus','OPEN')
            ->where('evidence_filename',null)         
            ->whereDate('duedate_action','<',now()->addDays(8))
            ->count();  
        $lupactionclosing = LUPAction::status('ON CLOSING')->count(); 
        $lupactioncancel = LUPAction::status('ON CANCEL')->count();   
        $mylupactioncancel = LUPAction::status('ON CANCEL')
            ->where('pic_action',Auth::user()->username)      
            ->count();   
        $lupactionextension = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->select('lup_parents.*', 'lup_actions.*')            
            ->whereNotNull('nolup')            
            ->where('actionstatus','ON EXTENSION')         
            ->count();        
        $lupactionextensionapproval = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->select('lup_parents.*', 'lup_actions.*')            
            ->whereNotNull('nolup')            
            ->where('actionstatus','ON EXTENSION APPROVAL')         
            ->count();          
        $mylupdisposisi = DB::table('lup_parents')
            ->leftjoin('related_departments', 'lup_parents.code', '=', 'related_departments.code')                              
            ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','related_departments.*')  
            ->where('related_departments.username',Auth::user()->username)    
            ->where('related_departments.signdate',null)  
            ->where('lup_parents.lupstatus','ON REVIEW')                       
            ->orderBy('lup_parents.id','desc')
            ->count();     
        $mylupregulatory_review = DB::table('lup_parents')            
            ->where('regulatory_reviewer',Auth::user()->username)             
            ->where('datesubmit_regulatory_approver',null)                       
            ->orderBy('id','desc')
            ->count();      
        $mylupregulatory_approval = DB::table('lup_parents')            
            ->where('regulatory_approver',Auth::user()->username)             
            ->where('datesign_regulatory_approver',null)                       
            ->orderBy('id','desc')
            ->count();       
        $mylupsubordinate = LUPParent::onleader()->count();
        $myluponprocess =LUPParent::myonprocess()->count();
        $myluponcancel =LUPParent::myoncancel()->count();
        $mylupactionreview = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->select('lup_parents.*', 'lup_actions.*')
            ->where('pic_action',Auth::user()->username)            
            ->where('lupstatus','APPROVED')            
            ->where('signdate_action',null)
            ->count();   
        $mylupactionopen = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->select('lup_parents.*', 'lup_actions.*')
            ->where('pic_action',Auth::user()->username)
            ->whereNotNull('nolup')            
            ->where('actionstatus','OPEN')
            ->where('evidence_filename',null)           
            ->whereDate('duedate_action','>=',now()->addDays(8))
            ->count();
            
        $mylupactionoverdue = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->select('lup_parents.*', 'lup_actions.*')
            ->where('pic_action',Auth::user()->username)
            ->whereNotNull('nolup')            
            ->where('actionstatus','OPEN')
            ->where('evidence_filename',null)         
            ->whereDate('duedate_action','<',now()->addDays(8))
            ->count();     
            
        $mylupactionextension = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->select('lup_parents.*', 'lup_actions.*')
            ->where('pic_action',Auth::user()->username)
            ->whereNotNull('nolup')            
            ->where('actionstatus','LIKE','ON EXTENSION%')         
            ->count();        
                      
        $mydeptlupactionopen = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->leftjoin('users', 'users.username', '=', 'lup_actions.pic_action')
            ->select('lup_parents.*', 'lup_actions.*','users.*','users.department as pic_dept')
            ->where('users.department',Auth::user()->department)
            ->whereNotNull('nolup')            
            ->where('duedate_status',1)
            ->where('deletion_flag',0)
            ->whereNull('dateapproved_evidence')
            ->whereDate('duedate_action','>=',now()->addDays(8))
            ->count();
        $mydeptlupactionoverdue = DB::table('lup_parents')
            ->join('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
            ->leftjoin('users', 'users.username', '=', 'lup_actions.pic_action')
            ->select('lup_parents.*', 'lup_actions.*','users.*','users.department as pic_dept',)
            ->where('users.department',Auth::user()->department)
            ->whereNotNull('nolup')            
            ->where('duedate_status',1)
            ->where('deletion_flag',0)
            ->whereNull('dateapproved_evidence')
            ->whereDate('duedate_action','<',now()->addDays(8))
            ->count();      


        //flp
                $flpsubordinate = DB::table('flpparents')->where('leader',Auth::user()->username)
                                                    ->where('datesign_leader',null)
                                                    ->count();
        $flponprocess = DB::table('flpparents')->where('inisiator',Auth::user()->username)
                                                    ->where('flpstatus','CREATE')
                                                    ->orWhere(function($query) {
                                                        $query->where('inisiator',Auth::user()->username)
                                                              ->where('flpstatus','ON PROCESS');
                                                    })->count();
        $flpactionreview = DB::table('flpparents')
            ->join('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*', 'flpactions.*')
            ->where('pic_action',Auth::user()->username)            
            ->where('flpstatus','ON PROCESS')            
            ->where('signdate_action',null)         
            ->count();                                     
            
        $myflpactionopen = DB::table('flpparents')
            ->join('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*', 'flpactions.*')
            ->where('pic_action',Auth::user()->username)
            ->whereNotNull('noflp')
            ->where('flpstatus','OPEN')
            ->where('actionstatus','OPEN')
            ->where('evidence_filename',null)           
            ->whereDate('duedate_action','>=',now()->addDays(8))
            ->count();
            
        $myflpactionoverdue = DB::table('flpparents')
            ->join('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*', 'flpactions.*')
            ->where('pic_action',Auth::user()->username)
            ->whereNotNull('noflp')
            ->where('flpstatus','OPEN')
            ->where('actionstatus','OPEN')
            ->where('evidence_filename',null)         
            ->whereDate('duedate_action','<',now()->addDays(8))
            ->count();     
            
        $myflpactionextension = DB::table('flpparents')
            ->join('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*', 'flpactions.*')
            ->where('pic_action',Auth::user()->username)
            ->whereNotNull('noflp')
            ->where('flpstatus','OPEN')
            ->where('actionstatus','ON EXTENSION')         
            ->count();        
                      
        $mydeptflpactionopen = DB::table('flpparents')
            ->join('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->leftjoin('users', 'users.username', '=', 'flpactions.pic_action')
            ->select('flpparents.*', 'flpactions.*','users.*','users.department as pic_dept',)
            ->where('users.department',Auth::user()->department)
            ->whereNotNull('noflp')
            ->where('flpstatus','OPEN')
            ->where('duedate_status',1)
            ->where('deletion_flag',0)
            ->whereNull('dateapproved_evidence')
            ->whereDate('duedate_action','>=',now()->addDays(8))
            ->count();
        $mydeptflpactionoverdue = DB::table('flpparents')
            ->join('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->leftjoin('users', 'users.username', '=', 'flpactions.pic_action')
            ->select('flpparents.*', 'flpactions.*','users.*','users.department as pic_dept',)
            ->where('users.department',Auth::user()->department)
            ->whereNotNull('noflp')
            ->where('flpstatus','OPEN')
            ->where('duedate_status',1)
            ->where('deletion_flag',0)
            ->whereNull('dateapproved_evidence')
            ->whereDate('duedate_action','<',now()->addDays(8))
            ->count();                                    
                                                 
        $allflp = DB::table('flpparents')->count();                                               
        $allflp_create = DB::table('flpparents')->where('flpstatus','CREATE')->count();
        $allflp_onprocess = DB::table('flpparents')->where('flpstatus','ON PROCESS')->count();
        $allflp_onreview = DB::table('flpparents')->where('flpstatus','ON REVIEW')->count();
        $allflp_onapproval = DB::table('flpparents')->where('flpstatus','ON APPROVAL')->count();
        $allflp_open = DB::table('flpparents')->where('flpstatus','OPEN')->count();
        $allflp_closed = DB::table('flpparents')->where('flpstatus','CLOSED')->count();
        $allflp_cancel = DB::table('flpparents')->where('flpstatus','CANCEL')->count();
        $maxflp =max($allflp_create,$allflp_onprocess,$allflp_onreview,$allflp_onapproval,$allflp_open,$allflp_closed,$allflp_cancel);                                            
        
        return view('dashboard',['flpsubordinate'=>$flpsubordinate,
                                'flponprocess'=>$flponprocess,
                                'flpactionreview'=>$flpactionreview,
                                'myflpactionopen'=>$myflpactionopen,
                                'myflpactionoverdue'=>$myflpactionoverdue,
                                'myflpactionextension'=>$myflpactionextension,
                                'mydeptflpactionopen'=>$mydeptflpactionopen,
                                'mydeptflpactionoverdue'=>$mydeptflpactionoverdue,
                                'allflp'=>$allflp,
                                'allflp_create'=>$allflp_create,
                                'allflp_onprocess'=>$allflp_onprocess,
                                'allflp_onreview'=>$allflp_onreview,
                                'allflp_onapproval'=>$allflp_onapproval,
                                'allflp_open'=>$allflp_open,
                                'allflp_closed'=>$allflp_closed,
                                'allflp_cancel'=>$allflp_cancel,
                                'maxflp'=>$maxflp,
                                'mylupdisposisi'=>$mylupdisposisi,
                                'mylupregulatory_review'=>$mylupregulatory_review,
                                'mylupregulatory_approval'=>$mylupregulatory_approval,
                                'mylupsubordinate'=>$mylupsubordinate,
                                'myluponprocess'=>$myluponprocess,     
                                'myluponcancel'=>$myluponcancel,                               
                                'mylupactionreview'=>$mylupactionreview,
                                'mylupactionopen'=>$mylupactionopen,
                                'mylupactioncancel'=>$mylupactioncancel,
                                'mylupactionoverdue'=>$mylupactionoverdue,
                                'mylupactionextension'=>$mylupactionextension,
                                'mydeptlupactionopen'=>$mydeptlupactionopen,
                                'mydeptlupactionoverdue'=>$mydeptlupactionoverdue,
                                'luponprocess'=>$luponprocess,
                                'luponreview'=>$luponreview,
                                'luponapproval'=>$luponapproval,
                                'luponapproved'=>$luponapproved,
                                'luponcancel'=>$luponcancel,
                                'luponclosing'=>$luponclosing,
                                'luponcancelapproval'=>$luponcancelapproval,
                                'luponclosingapproval'=>$luponclosingapproval,
                                'lupactionoverdue'=>$lupactionoverdue,
                                'lupactionclosing'=>$lupactionclosing,
                                'lupactioncancel'=>$lupactioncancel,
                                'lupactionextension'=>$lupactionextension,
                                'lupactionextensionapproval'=>$lupactionextensionapproval,
                                'quotes'=>$quotes,
                    ]);
    }
    public function tcode(Request $request)
    {
        $search = Str::upper($request->tcode);
        $length = Str::length($search);
        $first = Str::upper(Str::substr($search, 0, 1));
        
            
            if(FLPParent::where('code',$search)->exists()){             //search FLP by code       
                $flp = FLPParent::where('code',$search)->first()->id;
                $id = Crypt::encryptString($flp);                
                return redirect('/flp/'.$id.'/edit');
            }elseif(FLPParent::where('noflp',$search)->exists()){       //search FLP by no flp             
                $flp = FLPParent::where('noflp',$search)->first()->id;
                $id = Crypt::encryptString($flp);                
                return redirect('/flp/'.$id.'/edit');
            }elseif(MasterPart::where('rdms_part',$search)->exists()){  //search Part by Part No
                $masterpart = MasterPart::where('rdms_part',$search)->first()->id;
                $id = Crypt::encryptString($masterpart);                
                return redirect('/masterpart/'.$id.'/edit');
            }elseif(MasterPart::where('sap_desc','Like','%'.$search.'%')->exists()){
                $id = Str::lower($search);                            
                return redirect('/masterpart/query/'.$id);
            }elseif(LUPParent::where('code',$search)->exists()){       //search LUP by code           
                $lup = LUPParent::where('code',$search)->first()->id;
                $id = Crypt::encryptString($lup);                
                return redirect('/lup/'.$id.'/edit');
            }
            elseif(LUPParent::where('nolup',$search)->exists()){       //search LUP by no LUP           
                $lup = LUPParent::where('nolup',$search)->first()->id;
                $id = Crypt::encryptString($lup);                
                return redirect('/lup/'.$id.'/edit');
            }

            //shortcut menu
            if($search=="FLP03"){
                return redirect('/flp');
            }        
            if($search=="FLP01"){
                return redirect('/newflp');
            }
            if($search=="LUP03"){
                return redirect('/lup/masterlist');
            }        
            if($search=="LUP01"){
                return redirect('/lup/new');
            }
            if($search=="MM01"){
                return redirect('/newpart');
            }
            if($search=="USER03"){
                return redirect('/listusers');
            }
            if($search=="OUT"){
                return redirect('/logout');
            }
            return back()->with('warning','The following data or shortcut does not exist..');  
    }
}
