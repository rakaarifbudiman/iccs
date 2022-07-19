@extends('layouts.admin.master')
@section('title', 'Mail Setting')

@section('content')
<div class="pagetitle">
    <h1>Mail Setting</h1>
</div>  
  
  <section class="section profile">
    <div class="card">  
      <div class="card-body mt-3">   
              
  
                <!-- Mail Setting Form -->                
                <form action="/mail/setting/update" method="post" id="myForm">
                  @method('put')
                  @csrf                                         
                  <div class="row mb-3">
                    <label for="driver" class="col-md-4 col-lg-3 col-form-label">Driver</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="driver" type="text" class="form-control @error('driver') is-invalid @enderror" id="driver" value="{{ old('driver',$mailSetting->driver) }}"required autocomplete="off"/>                      
                    </div>
                  </div>     
                  <div class="row mb-3">
                    <label for="host" class="col-md-4 col-lg-3 col-form-label">Host</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="host" type="text" class="form-control @error('host') is-invalid @enderror" id="host" value="{{ old('host',$mailSetting->host) }}"required autocomplete="off"/>                      
                    </div>
                  </div>    
                  <div class="row mb-3">
                    <label for="port" class="col-md-4 col-lg-3 col-form-label">Port</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="port" type="text" class="form-control @error('port') is-invalid @enderror" id="port" value="{{ old('port',$mailSetting->port) }}"required autocomplete="off"/>                      
                    </div>
                  </div>      
                  <div class="row mb-3">
                    <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username',$mailSetting->username) }}"required autocomplete="off"/>                      
                    </div>
                  </div>           
                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password',$mailSetting->password) }}"required autocomplete="off"/>                      
                    </div>
                  </div>    
                  <div class="row mb-3">
                    <label for="encryption" class="col-md-4 col-lg-3 col-form-label">Encryption</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="encryption" type="encryption" class="form-control @error('encryption') is-invalid @enderror" id="encryption" value="{{ old('encryption',$mailSetting->encryption) }}" autocomplete="off"/>                      
                    </div>
                  </div>    
                  <div class="row mb-3">
                    <label for="from_address" class="col-md-4 col-lg-3 col-form-label">From Address</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="from_address" type="from_address" class="form-control @error('from_address') is-invalid @enderror" id="from_address" value="{{ old('from_address',$mailSetting->from_address) }}"required autocomplete="off"/>                      
                    </div>
                  </div>   
                  <div class="row mb-3">
                    <label for="from_name" class="col-md-4 col-lg-3 col-form-label">From Name</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="from_name" type="from_name" class="form-control @error('from_name') is-invalid @enderror" id="from_name" value="{{ old('from_name',$mailSetting->from_name) }}"required autocomplete="off"/>                      
                    </div>
                  </div> 
                  <div class="row mb-3">
                    <label for="datechangepassword" class="col-md-4 col-lg-3 col-form-label">Last Change Password</label>                    
                    <div class="col-md-8 col-lg-9">
                      <input name="datechangepassword" type="text" class="form-control @error('datechangepassword') is-invalid @enderror" id="datechangepassword" value="@date($mailSetting->datechangepassword,'d-M-y H:i:s')" disabled autocomplete="off"/>                      
                    </div>
                  </div>  
                  <input name="id" type="id" class="form-control @error('id') is-invalid @enderror" id="id" value="{{ $mailSetting->id }}" hidden autocomplete="off"/>                      
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="saveprofile">Save Changes</button>
                    <a href="/" class="btn btn-warning" name="dismiss">Dismiss</a>    
                  </div>
                </form> 
                        
      </div>              
                
    </div>         
                

              
  
              
  

  </section>



@stop
