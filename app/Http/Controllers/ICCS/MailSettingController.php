<?php

namespace App\Http\Controllers\ICCS;

use Illuminate\Http\Request;
use App\Models\ICCS\MailSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\ICCS\UpdateMailSettingRequest;

class MailSettingController extends Controller
{    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ICCS\MailSetting  $mailSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(MailSetting $mailSetting)
    {
        $mailSetting = MailSetting::where('active',1)->latest()->first();
        return view('settings.mailsetting', ['mailSetting' => $mailSetting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMailSettingRequest  $request
     * @param  \App\Models\ICCS\MailSetting  $mailSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMailSettingRequest $request, MailSetting $mailSetting)
    {
        $id=$request->id;
        $mailSetting = MailSetting::find($id);  
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('mail_settings'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $mailSetting->$field;
        }                

        //save process
        $mailSetting->driver = $request->driver;     
        $mailSetting->host = $request->host;  
        $mailSetting->port = $request->port;  
        $mailSetting->username = $request->username;  
        $mailSetting->password = $request->password;  
        $mailSetting->encryption = $request->encryption;  
        $mailSetting->from_address = $request->from_address;   
        $mailSetting->from_name = $request->from_name;    
        $mailSetting->update();  

        if($mailSetting->wasChanged()==TRUE){
            foreach($fields as $field){
                if($mailSetting->wasChanged($field)){
                    if($mailSetting->wasChanged('password')){
                        $mailSetting->datechangepassword=now();
                        $mailSetting->update();  
                        auditusers($mailSetting,Auth::user()->username,'Audit Change',$mailSetting->id,
                        'mail_settings','Password','','' );
                    }else{
                        if($old[$field]!=$mailSetting->$field ){                        
                            auditusers($mailSetting,Auth::user()->username,'Audit Change',$mailSetting->id,
                            'mail_settings',$field,$old[$field],$mailSetting->$field );
                        }
                    }                    
                }
            }            
            return back()->with('success','Data was Saved !');
        }else{
            return back()->with('info','Nothing Changed!');            
        }             
        
        
    }
    
}
