@extends('layouts.admin.master')

@section('title', 'Department ICCS')

@section('content')


<div class="pagetitle">
    <h1>Edit Department </h1>

</div>
  
  
  <section class="section profile">
    <div class="card">  
      <div class="card-body mt-3">   
              
  
                <!-- Department Edit Form -->
                
                <form action="/department/{{$departments->id}}/update" method="post" id="myForm">
                  @method('put')
                  @csrf                                   
                                       
                  <div class="row mb-3">
                    <label for="department" class="col-md-4 col-lg-3 col-form-label">Department</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="department" type="text" class="form-control @error('department') is-invalid @enderror" id="department" value="{{ old('department',$departments->department) }}"required autocomplete="off"/>
                      
                    </div>
                  </div> 
                  
                  
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="saveprofile">Save Changes</button>
                    <a href="/department" class="btn btn-warning" name="dismiss">Dismiss</a>    
                  </div>
                </form> 
                        
      </div>              
                
    </div>         
                

              
  
              
  

  </section>



@stop
