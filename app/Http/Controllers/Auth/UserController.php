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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;     
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);        
        $users = user::find($decrypted);     
        $this->authorize('update',$users);      
        $listgrades = Grade::all();
        $listusers = User::where([['active',1]])->get();
        $listapprovers = $listusers->where('level',3);        
        $listleaders = User::where([['active',1],['grade','Supervisor'],['department',$users->department]])
            ->orWhere([['active',1],['grade','Manager'],['department',$users->department]])
            ->orWhere([['active',1],['grade','Director'],['department',$users->department]])         
            ->get();        
        $listdepartments = Department::all();    
	    return view('users.users-profile', [
        'id'=>$id,
        'users' => $users,              
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
    public function update(Request $request, $id,User $users)
    {      
        $users = User::find($id);
        $this->authorize('update',$users);  
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
    public function destroy($id,User $users)
    {
        $userslogin = Auth::user()->id;
        $levellogin = Auth::user()->level;   
        $decrypted = Crypt::decryptString($id);
        $users = user::find($decrypted);
        $this->authorize('update',$users);          
        if ($levellogin>1){
            $users->delete();            
                return back()->with('success','User has been deleted!'); 
        }else{
            return back()->with('warning','You do not have authorization to delete this data...');
        }
    }

    public function deactivate(Request $request, $id,User $users)
    {
       
        $decrypted = Crypt::decryptString($id);
        $users = User::find($decrypted);       
        $this->authorize('update',$users);                        
        $users->active = 0;                        
        $users->save();
                                  
            auditusers($users,Auth::user()->username,'Deactivate User',$users->username,
            'users','active','1','0' );
       
        return back()->with('success','User has been deactivated!');           
    }  
        
    public function activate(Request $request, $id,User $users)
    {
        $decrypted = Crypt::decryptString($id);
        $users = User::find($decrypted);
        $this->authorize('update',$users);  
        if(!$users->name || !$users->email || !$users->grade || !$users->department || !$users->leader){            
            return back()->with('error','Please fill all data');
        }else{
            $oldactive = $users->active;                   
            $users->active = 1;                               
            $users->save();                                 
                auditusers($users,Auth::user()->username,'User Activation',$users->username,
                'users','active','0','1' );            
            
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
            $emailto = $users->email;
            foreach($emailreviewers as $email){
                $emailcc[]=$email->email;
            }
            
            Mail::to(env('MAIL_TO_TESTING'))
            ->cc(env('MAIL_TO_TESTING'))   
            ->send(new NotifyUserActive($mailData));

        return back()->with('success','User has been activated!');   
            
        }
    }           

    public function changepassword(Request $request, $id,User $user)
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
        $this->authorize('changepassword',$user);  
        if(Hash::check($request->password, $user->password)){
            return back()->with('error','Failed...You cannot use your old password, Please choose a new one');
        }
        $user->password = Hash::make($request->password); 
        $user->password_change_at = now();                                         
        $user->save();  
        if($user->wasChanged('password')){                            
            auditusers($user,Auth::user()->username,'Change Password',$user->username,
            'users','Password','','' );
        }                              
        return back()->with('success','Password has been changed!');
    }

    public function editpassword($id,$tab,User $users)
    {
        $decrypted = Crypt::decryptString($id);        
        $users = user::find($decrypted);
        $this->authorize('changepassword',$users);
        $listgrades = Grade::all();
        $listleaders = User::where([['active',1],['grade','Supervisor']])
        ->orWhere([['active',1],['grade','Manager']])
        ->orWhere([['active',1],['grade','Director']])         
        ->get();
        
        $listdepartments = Department::all();   
            
                return view('users.change-password', [
                'users' => $users,                
                'listleaders'=>$listleaders,
                'listdepartments'=>$listdepartments,
                'listgrades'=>$listgrades        
                ]);
                 
    }
     
    
    
    
            
            
         

}
