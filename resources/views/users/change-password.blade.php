@extends('layouts_old.main')

@section('title', 'User Profile ICCS')

@section('content')


<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Change Password</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
  
  
  <section class="section profile">
    <div class="row">
      
  
      <div class="col-xl-8">
  
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
           
             
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>
              
  
            </ul>
            <div class="tab-content pt-2">  
                
              <div class="tab-pane fade show active pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="/users-profile/{{$users->id}}/changepassword" method="post" id="myForm">                
                  @csrf
                  @method('put')
                  
                  <div class="row mb-3">
                    <div class="input-group has-validation">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password*</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password" minlength=8>
                        
                      </div>
                    </div>
                  </div>
  
                  <div class="row mb-3">
                    <div class="input-group has-validation">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" minlength="8">
                      </div>
                    </div>
                  </div>
                  <nav>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">*Password length min.8 character, contain at least mixed case (lower, upper case, number, and symbol)</li>                      
                    </ol>
                  </nav>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="savepassword">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->
  
              </div>
  
            </div><!-- End Bordered Tabs -->
  
          </div>
        </div>
  
      </div>
    </div>
  </section>

  
  
@stop
