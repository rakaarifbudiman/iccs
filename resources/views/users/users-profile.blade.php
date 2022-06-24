@extends('layouts.main')

@section('title', 'User Profile ICCS')

@section('content')


<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  
  
  <section class="section profile">
    <div class="row">
      
  
      <div class="col-xl-8">
  
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
  
              
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>
              
             {{--  @if ($hidden1=="") --}}
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" {{ $hidden1=="" ? '' : $hidden1 }}>Edit Profile</button>
                </li>            
              {{-- @endif --}}
              {{-- @if ($hidden2=="")  --}}
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" {{ $hidden2=="" ? '' : $hidden2 }}>Change Password</button>
                </li>
              {{-- @endif --}}
  
            </ul>
            <div class="tab-content pt-2">
  
              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Notes</h5>
                <p class="small fst-italic">
                {{$user->notes}}
  
                <h5 class="card-title">Profile Details</h5>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">
                    {{$user->name}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Username</div>
                  <div class="col-lg-9 col-md-8">
                    {{$user->username}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Department</div>
                  <div class="col-lg-9 col-md-8">
                  {{$user->department}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Leader</div>
                  <div class="col-lg-9 col-md-8">
                  {{$user->leader}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Job Grade</div>
                  <div class="col-lg-9 col-md-8">
                  {{$user->grade}}
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Level</div>
                  <div class="col-lg-9 col-md-8">
                  {{$level}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Active</div>
                  <div class="col-lg-9 col-md-8">
                    {{$active}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">
                  {{$user->email}}
                  </div>
                </div>
  
              </div>
              
            @if ($hidden1=="")
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
  
                <!-- Profile Edit Form -->
                
                <form action="/users-profile/update/{{$user->id}}" method="post" id="myForm">
                  @method('put')
                  @csrf                 
                    
                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="{{ old('name',$user->name) }}" required/>
  
                    </div>
                    
                  </div>
  
                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{ old('email',$user->email) }}"required autocomplete="off"/>
                    </div>
                    
                  </div>

                  <div class="row mb-3">
                    <label for="grade" class="col-md-4 col-lg-3 col-form-label">Job Grade*</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="grade" list="listgrade" class="form-control" id="grade" value="{{ old('grade',$user->grade) }}"required autocomplete="off"/>
                      <datalist id="listgrade">
                        @foreach ($listgrades as $index=>$listgrade) 
                        <option value="{{ $listgrade->grade }}">{{ $listgrade->grade }}</option>
                        @endforeach
                      </datalist> 
                      @error('grade')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror  
                    </div>
                    
                  </div>
                     
                  <div class="row mb-3">
                    <label for="department" class="col-md-4 col-lg-3 col-form-label">Department*</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="department" list="listdepartment" class="form-control" id="department" value="{{ old('department',$user->department) }}"required autocomplete="off"/>
                      <datalist id="listdepartment">
                        @foreach ($listdepartments as $index=>$listdepartment) 
                        <option value="{{ $listdepartment->department }}">{{ $listdepartment->department }}</option>
                        @endforeach
                      </datalist> 
                      @error('department')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror  
                    </div>
                    
                  </div>
  
                  <div class="row mb-3">
                    <label for="leader" class="col-md-4 col-lg-3 col-form-label">Leader*</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="leader" list="listleader" class="form-control" id="leader" value="{{ old('leader',$user->leader) }}" autocomplete="off">
                      <datalist id="listleader">
                        @foreach ($listleaders as $index=>$listleader) 
                        <option value="{{ $listleader->username }}">{{ $listleader->username }} - {{ $listleader->name }} - {{ $listleader->department }}</option>
                        @endforeach
                      </datalist>  
                      @error('leader')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror                      
                    </div>
                                    
                  </div> 

                  <div class="row mb-3">
                    <label for="level" class="col-md-4 col-lg-3 col-form-label">Level</label>                    
                    <div class="col-md-8 col-lg-9">                      
                      <input name="level" list="listlevel" class="form-control" id="level" value="{{ old('level',$level) }}" {{ $disabled }} required/>
                      <datalist id="listlevel">
                        
                        <option value="1">User</option>
                        <option value="2">Reviewer</option>
                        <option value="3">Approver</option>
                        

                      </datalist> 
                    </div>
                  </div>  
                  
                  <div class="row mb-3">
                    <label for="active" class="col-md-4 col-lg-3 col-form-label">Active</label>                    
                    <div class="col-md-8 col-lg-9">                      
                      <input name="active" type="text" class="form-control" id="active" value="{{ old('active',$active) }}" {{ $disabled }} required/>
                    </div>
                  </div>  
                                    
                  <div class="row mb-3">
                    <label for="notes" class="col-md-4 col-lg-3 col-form-label">Notes</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="notes" class="form-control" id="notes" style="height: 100px">{{old('notes',$user->notes) }}</textarea>
                    </div>
                  </div>
                  <nav>
                    <ol class="breadcrumb">                      
                      <li class="breadcrumb-item">*Please fill data required based on suggestion/drop down list</li>                      
                    </ol>
                  </nav>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="saveprofile">Save Changes</button>
                        
                  </div>
                </form>
                <div class="text-center mt-1">
                <form action="{{ $buttonlink }}" method="post" id="myForm">
                  @method('put')
                  @csrf  
                  <button type="submit" class="{{ $buttoncolor }}" name="activebutton" {{ $hidebutton }}>{{ $buttoncaption }}</button> {{-- //button for activate or deactivate user --}}                        
                </form>
                
              </div>
            @endif    

              </div>    {{--  End Profile Edit Form    --}}    
  
              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="/users-profile/{{$user->id}}/changepassword" method="post" id="myForm">                
                  @csrf
                  @method('put')
                  
                  <div class="row mb-3">
                    <div class="input-group has-validation">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password*</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="newPassword" minlength=8>
                        
                      </div>
                    </div>
                  </div>
  
                  <div class="row mb-3">
                    <div class="input-group has-validation">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" type="password" class="form-control" id="renewPassword" minlength="8">
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
</div><!-- End Page Title -->
 
  
@stop
