<?php

namespace App\Http\Controllers\Auth;
use Mail;
use Validator;
use App\Models\User;
use App\Models\ICCS\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ICCS\Department;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\Mail\Auth\NotifyUserActive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\DatabaseRule;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = user::all();
	    return view('users.listusers', ['user' => $user]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);        
        $user = user::find($decrypted);

        if ($user->active==0){
            $active = 'No';
        }else{
            $active = 'Yes';
        }

        if ($user->level==1){
            $level = 'User';
        }elseif($user->level==2){
            $level = 'Reviewer';
        }elseif($user->level==3){
            $level = 'Approver';
        }elseif($user->level==4){
            $level = 'Super User';
        }

        $userlogin = Auth::user()->id;
        $levellogin = Auth::user()->level;
        //hidden field at Profile Edit Form         
        if ($userlogin==$decrypted or $levellogin>1){
            $hidden1 = '';
            $hidden2 = '';
        }else{
            $hidden1 = 'disabled';
            $hidden2 = 'disabled';
        }
        //hidden button activate user or deactivate user
        if ($levellogin>1){
            if ($user->active==0){
                $hidebutton = '';
                $buttoncaption = 'Activate User ?';
                $buttoncolor = 'btn btn-success';
                $buttonlink = '/users-profile/activate/'.$id;

            }else{
                $hidebutton = '';
                $buttoncaption = 'Deactivate User ?';
                $buttoncolor = 'btn btn-danger';
                $buttonlink = '/users-profile/deactivate/'.$id;
            }
            
        }else{
            $hidebutton = 'hidden';
            $buttoncaption = '';
            $buttoncolor = '';
            $buttonlink = '';
        }
        // disable Nav Tab if user level = 'user'
        if ($user->level<2){
            $disabled = 'disabled';
        }else{
            $disabled = '';
        }

        $listgrades = Grade::all();
        

        $listusers = User::where([['active',1]])         
        ->get();
        $listapprovers = $listusers->where('level',3);        
        $listleaders = User::where([['active',1],['grade','Supervisor'],['department',$user->department]])
        ->orWhere([['active',1],['grade','Manager'],['department',$user->department]])
        ->orWhere([['active',1],['grade','Director'],['department',$user->department]])         
        ->get();
        
        $listdepartments = Department::all();
        
        
    if ($userlogin==$decrypted or $levellogin>1){
	    return view('users.users-profile', ['user' => $user,
        'active' =>$active,
        'disabled'=>$disabled,
        'level'=>$level,
        'hidden1'=>$hidden1,
        'hidden2'=>$hidden2,
        'hidebutton'=>$hidebutton,
        'buttoncaption'=>$buttoncaption,
        'buttoncolor'=>$buttoncolor,
        'buttonlink'=>$buttonlink,
        'listleaders'=>$listleaders,
        'listdepartments'=>$listdepartments,
        'listgrades'=>$listgrades        
        ]);
    }else{
        return back()->with('warning','You do not have authorization to edit this data...');
    }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $user = User::find($id);  
        if ($user->email == $request->email){
            
            $request->validate([            
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'regex:/^[AZa-z\.]*@(sohoglobalhealth)[.](com)$/'],                      
                'department' => ['required','exists:departments'],            
                'grade' => ['required','exists:grades'],
                'leader' => ['required','exists:users,username,active,1,department,'.$user->department]   
            ]);
        }else{            
            $request->validate([            
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:/^[AZa-z\.]*@(sohoglobalhealth)[.](com)$/'],                      
                'department' => ['required','exists:departments'],            
                'grade' => ['required','exists:grades'],
                'leader' => ['required','exists:users,username,active,1,department,'.$user->department]   
            ]);
        }      
        
            
            
            


               
            //get old value     
            $oldname = $user ->name;
            $oldemail =$user->email;
            $oldgrade =$user->grade;
            $olddepartment =$user->department;
            $oldleader =$user->leader;
            $oldactive =$user->active;
            $oldnotes =$user->notes;

            //save process
            $user->name = $request->name;           
            
            $user->email = $request->email;
                 
            $user->grade = $request->grade;
            $user->department = $request->department;
            $user->leader = $request->leader; 
            if($request->active=='Yes'){
                $user->active = 1;
            }elseif($request->active=='No'){
                $user->active = 0;
            }            
            $user->notes = $request->notes;
            $user->save();      
            

            $check = $user->wasChanged(); 
            if ($check==True){
                //add to AuditUsers Table
                if ($user->waschanged('name')==True){
                    DB::table('auditusers')->insert([
                   
                        'change_by' => Auth::user()->username,        
                        'activity' => 'Audit Change',
                        'recordid' => $user->username,
                        'sourcetable' => 'users',
                        'sourcefield' => 'name',
                        'beforevalue' => $oldname,
                        'aftervalue' => $request->name,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    ]);
                }
                if ($user->waschanged('email')==True){
                    DB::table('auditusers')->insert([
                   
                        'change_by' => Auth::user()->username,        
                        'activity' => 'Audit Change',
                        'recordid' => $user->username,
                        'sourcetable' => 'users',
                        'sourcefield' => 'email',
                        'beforevalue' => $oldemail,
                        'aftervalue' => $request->email,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    ]);
                }
                if ($user->waschanged('grade')==True){
                    DB::table('auditusers')->insert([
                   
                        'change_by' => Auth::user()->username,        
                        'activity' => 'Audit Change',
                        'recordid' => $user->username,
                        'sourcetable' => 'users',
                        'sourcefield' => 'grade',
                        'beforevalue' => $oldgrade,
                        'aftervalue' => $request->grade,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    ]);
                }
                if ($user->waschanged('department')==True){
                    DB::table('auditusers')->insert([
                   
                        'change_by' => Auth::user()->username,        
                        'activity' => 'Audit Change',
                        'recordid' => $user->username,
                        'sourcetable' => 'users',
                        'sourcefield' => 'department',
                        'beforevalue' => $olddepartment,
                        'aftervalue' => $request->department,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    ]);
                }
                if ($user->waschanged('leader')==True){
                    DB::table('auditusers')->insert([
                   
                        'change_by' => Auth::user()->username,        
                        'activity' => 'Audit Change',
                        'recordid' => $user->username,
                        'sourcetable' => 'users',
                        'sourcefield' => 'leader',
                        'beforevalue' => $oldleader,
                        'aftervalue' => $request->leader,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    ]);
                }
                if ($user->waschanged('active')==True){
                    DB::table('auditusers')->insert([
                   
                        'change_by' => Auth::user()->username,        
                        'activity' => 'Audit Change',
                        'recordid' => $user->username,
                        'sourcetable' => 'users',
                        'sourcefield' => 'active',
                        'beforevalue' => $oldactive,
                        'aftervalue' => $request->active,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    ]);
                }
                if ($user->waschanged('notes')==True){
                    DB::table('auditusers')->insert([
                   
                        'change_by' => Auth::user()->username,        
                        'activity' => 'Audit Change',
                        'recordid' => $user->username,
                        'sourcetable' => 'users',
                        'sourcefield' => 'notes',
                        'beforevalue' => $oldnotes,
                        'aftervalue' => $request->notes,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    ]);
                }
                 
                return back()->with('success','Data edited successfully!');
            }            
            else{
                return back()->with('info','Nothing Changed');
            }
        /*     foreach ($errors->all() as $message) {
                return back()->with('error',$message);
            } */
                       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userlogin = Auth::user()->id;
        $levellogin = Auth::user()->level;   
        $decrypted = Crypt::decryptString($id);
        $user = user::find($decrypted);
        
        if ($levellogin>1){
            $user->delete();
            
                return back()->with('success','User has been deleted!'); 
        }else{
            return back()->with('warning','You do not have authorization to delete this data...');
        }

    }

    public function deactivate(Request $request, $id)
    {
       
        $decrypted = Crypt::decryptString($id);
        $user = User::find($decrypted);                             
        $user->active = 0;                        
        $user->save();
        return back()->with('success','User has been deactivated!');           
    }  
                  
        

        
    public function activate(Request $request, $id)
    {
        $decrypted = Crypt::decryptString($id);
        $user = User::find($decrypted);
        if(!$user->name || !$user->email || !$user->grade || !$user->department || !$user->leader){            
            return back()->with('error','Please fill all data');
        }else{
            $oldactive = $user->active;                   
            $user->active = 1;                               
            $user->save();
            if ($user->waschanged('active')==True){
                DB::table('auditusers')->insert([
            
                    'change_by' => Auth::user()->username,        
                    'activity' => 'User Activation',
                    'recordid' => $user->username,
                    'sourcetable' => 'users',
                    'sourcefield' => 'active',
                    'beforevalue' => 0,
                    'aftervalue' => 1,
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                ]);
            }
            $urllogin = '<a href="'.env('APP_URL').'" style="
            background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
            inline-block;text-decoration: none;"'.'>Login ICCS</a>'; 
            $mailData = [
                'user' => $user->username,
                'grade'=> $user->grade,
                'department'=> $user->department,
                'leader'=> $user->leader,
                'urllogin'=>$urllogin
            ]; 

            $emailreviewers = DB::table('users')
            ->where('level',2)
            ->where('active',1)->get('email');  
            $emailto = $emailreviewers->implode('email',',');
            Mail::to(env('MAIL_TO_TESTING'))
            ->cc($user->email)   
            ->send(new NotifyUserActive($mailData));

        return back()->with('success','User has been activated!');   
            
        }
    }
        
          
                    
            
            
            
              
                    

    public function changepassword(Request $request, $id)
    {
        
        $request->validate([
            
            'password' => ['required', 'confirmed', Password::min(8)
                            ->letters()
                            ->mixedcase()
                            ->numbers() 
                            ->symbols()
                            ->uncompromised()
                            ],
        ]);

        $user = User::find($id); 
        $user->password = Hash::make($request->password);                                     
        $user->save();  
                                      
        return back()->with('success','Password has been changed!');           

    }

    public function editpassword($id,$tab)
    {
        $decrypted = Crypt::decryptString($id);        
        $user = user::find($decrypted);

              
        if ($user->active==0){
            $active = 'No';
        }else{
            $active = 'Yes';
        }

        if ($user->level==1){
            $level = 'User';
        }elseif($user->level==2){
            $level = 'Reviewer';
        }elseif($user->level==3){
            $level = 'Approver';
        }elseif($user->level==4){
            $level = 'Super User';
        }

        $userlogin = Auth::user()->id;
        $levellogin = Auth::user()->level;
        //hidden field at Profile Edit Form  
        if($tab=="changepassword"){
            if ($userlogin==$decrypted or $levellogin>1){
                $hidden1 = 'disabled';
                $hidden2 = '';
            }else{
                $hidden1 = 'disabled';
                $hidden2 = 'disabled';
            }
        }else{
            $hidden1 = 'disabled';
            $hidden2 = 'disabled';
        }
           
        //hidden button activate user or deactivate user
        if ($levellogin>1){
            if ($user->active==0){
                $hidebutton = '';
                $buttoncaption = 'Activate User ?';
                $buttoncolor = 'btn btn-success';
                $buttonlink = '/users-profile/activate/'.$id;

            }else{
                $hidebutton = '';
                $buttoncaption = 'Deactivate User ?';
                $buttoncolor = 'btn btn-danger';
                $buttonlink = '/users-profile/deactivate/'.$id;
            }
            
        }else{
            $hidebutton = 'hidden';
            $buttoncaption = '';
            $buttoncolor = '';
            $buttonlink = '';
        }
        // disable Nav Tab if user level = 'user'
        if ($user->level<2){
            $disabled = 'disabled';
        }else{
            $disabled = '';
        }

        $listgrades = Grade::all();

        $listleaders = User::where([['active',1],['grade','Supervisor']])
        ->orWhere([['active',1],['grade','Manager']])
        ->orWhere([['active',1],['grade','Director']])         
        ->get();
        
        $listdepartments = Department::all();
        
        
            if ($userlogin==$decrypted or $levellogin>1){
                return view('users.change-password', ['user' => $user,
                'active' =>$active,
                'disabled'=>$disabled,
                'level'=>$level,
                'hidden1'=>$hidden1,
                'hidden2'=>$hidden2,
                'hidebutton'=>$hidebutton,
                'buttoncaption'=>$buttoncaption,
                'buttoncolor'=>$buttoncolor,
                'buttonlink'=>$buttonlink,
                'listleaders'=>$listleaders,
                'listdepartments'=>$listdepartments,
                'listgrades'=>$listgrades        
                ]);
            }else{
                return back()->with('warning','You do not have authorization to edit this data...');
            }
        
    }
     
    
    
    
            
            
         

}
