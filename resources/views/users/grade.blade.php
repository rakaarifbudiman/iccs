@extends('layouts.main')

@section('title', 'Grade ICCS')

@section('content')
<div class="pagetitle">
    <h1>Edit Grade </h1>

</div>
  
  
  <section class="section profile">
    <div class="card">  
      <div class="card-body mt-3">   
              
  
                <!-- grade Edit Form -->
                
                <form action="/grade/{{$grades->id}}/update" method="post" id="myForm">
                  @method('put')
                  @csrf                                   
                                       
                  <div class="row mb-3">
                    <label for="grade" class="col-md-4 col-lg-3 col-form-label">grade</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="grade" type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" value="{{ old('grade',$grades->grade) }}"required autocomplete="off"/>
                      
                    </div>
                  </div> 
                  
                  
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="saveprofile">Save Changes</button>
                    <a href="/grade" class="btn btn-warning" name="dismiss">Dismiss</a>    
                  </div>
                </form> 
                        
      </div>              
                
    </div>         
                

              
  
              
  

  </section>



@stop
