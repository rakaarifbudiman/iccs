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
use Illuminate\Support\Facades\Schema;
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
        $users = user::all();
	    return view('users.listusers', ['user' => $users]);
        
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
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);        
        $users = user::find($decrypted);
        $userslogin = Auth::user()->id;
        $levellogin = Auth::user()->level;
        
        //hidden field at Profile Edit Form         
        if ($userslogin==$decrypted or $levellogin>1){
            $hidden1 = '';
            $hidden2 = '';
        }else{
            $hidden1 = 'disabled';
            $hidden2 = 'disabled';
        }
        //hidden button activate user or deactivate user
        if ($levellogin>1){
            if ($users->active==0){
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
        if ($users->level<2){
            $disabled = 'disabled';
        }else{
            $disabled = '';
        }

        $listgrades = Grade::all();
        

        $listusers = User::where([['active',1]])         
        ->get();
        $listapprovers = $listusers->where('level',3);        
        $listleaders = User::where([['active',1],['grade','Supervisor'],['department',$users->department]])
        ->orWhere([['active',1],['grade','Manager'],['department',$users->department]])
        ->orWhere([['active',1],['grade','Director'],['department',$users->department]])         
        ->get();
        
        $listdepartments = Department::all();
        
        
    
	    return view('users.users-profile', [
        'user' => $users,        
        'disabled'=>$disabled,        
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
    
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $users = User::find($id);  
        if ($users->email == $request->email){
            
            $request->validate([            
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'regex:/^[AZa-z\.]*@(sohoglobalhealth)[.](com)$/'],                      
                'department' => ['required','exists:departments'],            
                'grade' => ['required','exists:grades'],
                'leader' => ['required','exists:users,username,active,1']   
            ]);
        }else{            
            $request->validate([            
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:/^[AZa-z\.]*@(sohoglobalhealth)[.](com)$/'],                      
                'department' => ['required','exists:departments'],            
                'grade' => ['required','exists:grades'],
                'leader' => ['required','exists:users,username,active,1']   
            ]);
        }      
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('users'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $users->$field;
        }   
            //save process
            $users->name = $request->name;           
            $users->email = $request->email;                
            $users->grade = $request->grade;
            $users->department = $request->department;
            $users->leader = $request->leader; 
            if($request->active=='Yes'){
                $users->active = 1;
            }elseif($request->active=='No'){
                $users->active = 0;
            }
            if(Auth::user()->level==3){
                if($request->level=='User'){                    
                    $users->level = 1;
                }elseif($request->level=='Reviewer'){                    
                    $users->level = 2;
                }elseif($request->level=='Approver'){                    
                    $users->level = 3;
                }                
            }            
            $users->notes = $request->notes;
            $users->save();          

            if($users->wasChanged()==TRUE){
                foreach($fields as $field){
                    if($users->wasChanged($field)){
                        if($users->wasChanged('password')){                            
                            auditusers($users,Auth::user()->username,'Audit Change',$users->username,
                            'users','Password','','' );
                        }else{
                            if($old[$field]!=$users->$field ){                        
                                auditusers($users,Auth::user()->username,'Audit Change',$users->username,
                                'users',$field,$old[$field],$users->$field );
                            }
                        }                    
                    }
                }            
                return back()->with('success','Data was Saved !');
            }else{
                return back()->with('info','Nothing Changed!');            
            }             
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userslogin = Auth::user()->id;
        $levellogin = Auth::user()->level;   
        $decrypted = Crypt::decryptString($id);
        $users = user::find($decrypted);        
        if ($levellogin>1){
            $users->delete();            
                return back()->with('success','User has been deleted!'); 
        }else{
            return back()->with('warning','You do not have authorization to delete this data...');
        }
    }

    public function deactivate(Request $request, $id)
    {
       
        $decrypted = Crypt::decryptString($id);
        $users = User::find($decrypted);                             
        $users->active = 0;                        
        $users->save();
        return back()->with('success','User has been deactivated!');           
    }  
        
    public function activate(Request $request, $id)
    {
        $decrypted = Crypt::decryptString($id);
        $users = User::find($decrypted);
        if(!$users->name || !$users->email || !$users->grade || !$users->department || !$users->leader){            
            return back()->with('error','Please fill all data');
        }else{
            $oldactive = $users->active;                   
            $users->active = 1;                               
            $users->save();
            if ($users->waschanged('active')==True){
                DB::table('auditusers')->insert([
            
                    'change_by' => Auth::user()->username,        
                    'activity' => 'User Activation',
                    'recordid' => $users->username,
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
                'user' => $users->username,
                'grade'=> $users->grade,
                'department'=> $users->department,
                'leader'=> $users->leader,
                'urllogin'=>$urllogin
            ]; 

            $emailreviewers = DB::table('users')
            ->where('level',2)
            ->where('active',1)->get('email');  
            $emailto = $emailreviewers->implode('email',',');
            Mail::to(env('MAIL_TO_TESTING'))
            ->cc($users->email)   
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

        $users = User::find($id); 
        $users->password = Hash::make($request->password);                                     
        $users->save();  
                                      
        return back()->with('success','Password has been changed!');           

    }

    public function editpassword($id,$tab)
    {
        $decrypted = Crypt::decryptString($id);        
        $users = user::find($decrypted);
              
        if ($users->active==0){
            $active = 'No';
        }else{
            $active = 'Yes';
        }

        if ($users->level==1){
            $level = 'User';
        }elseif($users->level==2){
            $level = 'Reviewer';
        }elseif($users->level==3){
            $level = 'Approver';
        }elseif($users->level==4){
            $level = 'Super User';
        }

        $userslogin = Auth::user()->id;
        $levellogin = Auth::user()->level;
        //hidden field at Profile Edit Form  
        if($tab=="changepassword"){
            if ($userslogin==$decrypted or $levellogin>1){
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
            if ($users->active==0){
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
        if ($users->level<2){
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
            
                return view('users.change-password', ['user' => $users,
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
                 
    }
     
    
    
    
            
            
         

}
