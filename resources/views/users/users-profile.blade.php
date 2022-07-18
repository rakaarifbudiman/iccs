@extends('layouts.admin.master')

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
            <ul class="nav nav-tabs nav-tabs-bordered" id="UserMenu">
                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#profile-overview">Overview</a>
                </li>    
                @can('update',$users)
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile-edit">Edit Profile</a>
                  </li>
                @endcan
                @can('changepassword',$users)                              
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#profile-change-password">Change Password</a>
                </li>
                @endcan 
            </ul>              
            <div class="tab-content pt-2">  
              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Notes</h5>
                <p class="small fst-italic">
                {{$users->notes}}  
                <h5 class="card-title">Profile Details</h5>  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">
                    {{$users->name}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Username</div>
                  <div class="col-lg-9 col-md-8">
                    {{$users->username}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Department</div>
                  <div class="col-lg-9 col-md-8">
                  {{$users->department}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Leader</div>
                  <div class="col-lg-9 col-md-8">
                  {{$users->leader}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Job Grade</div>
                  <div class="col-lg-9 col-md-8">
                  {{$users->grade}}
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Level</div>
                  <div class="col-lg-9 col-md-8">
                  {{$users->level==1 ? 'User' :($users->level==2 ? 'Reviewer' :($users->level==3 ? 'Approver' :''))}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Active</div>
                  <div class="col-lg-9 col-md-8">
                    {{$users->active==1 ? 'Yes' : 'No'}}
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">
                  {{$users->email}}
                  </div>
                </div>
  
              </div>
              
            @can('update',$users)           
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit"> 
                <!-- Profile Edit Form -->                
                <form action="/users-profile/update/{{$users->id}}" method="post" id="myForm">
                  @method('put')
                  @csrf                 
                    
                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="{{ old('name',$users->name) }}" required/>
  
                    </div>
                    
                  </div>
  
                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{ old('email',$users->email) }}"required autocomplete="off"/>
                    </div>
                    
                  </div>

                  <div class="row mb-3">
                    <label for="grade" class="col-md-4 col-lg-3 col-form-label">Job Grade*</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="grade" list="listgrade" class="form-control" id="grade" value="{{ old('grade',$users->grade) }}"required autocomplete="off"/>
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
                      <input name="department" list="listdepartment" class="form-control" id="department" value="{{ old('department',$users->department) }}"required autocomplete="off"/>
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
                      <input name="leader" list="listleader" class="form-control" id="leader" value="{{ old('leader',$users->leader) }}" autocomplete="off">
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
                      <input name="level" list="listlevel" class="form-control" id="level" value="{{ old('level',$users->level==1 ? 'User' :
                      ($users->level==2 ? 'Reviewer' :($users->level==3 ? 'Approver' :''))) }}" 
                      {{ ($users->active==1 && Auth::user()->level>1) ?'':'disabled' }} required/>
                      <datalist id="listlevel">                        
                        <option value="User">User</option>
                        <option value="Reviewer">Reviewer</option>
                        <option value="Approver">Approver</option>                   

                      </datalist> 
                    </div>
                  </div>  
                  
                  <div class="row mb-3">
                    <label for="active" class="col-md-4 col-lg-3 col-form-label">Active</label>                    
                    <div class="col-md-8 col-lg-9">                      
                      <input name="active" type="text" class="form-control" id="active" value="{{ old('active',$users->active==1 ? 'Yes' : 'No') }}" 
                      {{ ($users->active==1 && Auth::user()->level>1) ?'':'disabled' }} required/>
                    </div>
                  </div>                                    
                  <div class="row mb-3">
                    <label for="notes" class="col-md-4 col-lg-3 col-form-label">Notes</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="notes" class="form-control" id="notes" style="height: 100px">{{old('notes',$users->notes) }}</textarea>
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
                  <form action="{{ ($users->active==1 && Auth::user()->level>1) ? '/users-profile/deactivate/'.$id : '/users-profile/activate/'.$id }}" method="post" id="myForm">
                    @method('put')
                    @csrf  
                    <button type="submit" class="{{ ($users->active==1 && Auth::user()->level>1) ? 'btn btn-danger' : 'btn btn-success' }}" name="activebutton" 
                      {{ Auth::user()->level>1 ?'' : 'hidden' }}>
                      {{ ($users->active==1 && Auth::user()->level>1) ? 'Deactivate User ?' : 'Activate User ?' }}
                    </button>                       
                  </form>                
                </div>
            @endcan    

              </div>    {{--  End Profile Edit Form    --}}
              @can('changepassword',$users)  
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="/users-profile/{{$users->id}}/changepassword" method="post" id="myForm">                
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
              @endcan
  
            </div><!-- End Bordered Tabs -->
  
          </div>
        </div>
  
      </div>
    </div>
  </section>
</div><!-- End Page Title -->  
@stop
