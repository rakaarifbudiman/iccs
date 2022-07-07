@extends('layouts.main')
@section('title', 'New LUP')
@section('content')
<div class="pagetitle">
    {{-- <h1>Review LUP</h1> --}}    
    <nav style="--bs-breadcrumb-divider: '| ';">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
        <li class="breadcrumb-item"><a href="/lup/masterlist">Master List LUP | </a></li>      
        <li class="breadcrumb-item active">
          <a href="#" onclick="event.preventDefault(); document.getElementById('submit-form').submit();" title="Save">
            <i class="ri-save-3-fill" ></i>
          </a>
        </li>
      </ol>     
    </nav> 
  <section class="section profile mt-2">
    <div class="row">      
        <div class="col-sm">  
        <div class="card">
          <div class="card-body pt-1">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" id="LUPMenu">  
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#initiation">Change Initiation</a>
              </li>               
            </ul>            
            <div class="tab-content pt-2">
                  <div class="tab-pane fade initiation pt-3" id="initiation">  <!-- Details Form -->                
                    <form id="submit-form" validate class="row g-3" method="POST" action="/lup/store">
                      @csrf                      
                      <div class="col-md-12 mb-2">
                        <div class="form-floating">
                          <input type="text" class="form-control" @error('documentname') is-invalid @enderror name="documentname" id="documentname" placeholder="Title" value = "{{ old('documentname') }}" required autofocus autocomplete="off" >
                          <label for="documentname">Title</label>
                        </div>
                      </div>     
                      <div class="row">
                            <div class="col-md-4 mb-2">                         
                              <div class="form-input input-sm">
                                <button href="#" class="btn btn-primary text-white edit" data-bs-toggle="modal" data-bs-target="#modaleditluptype" title="Edit Action Plan"><i class="ri-edit-2-fill"></i></button>                                                                                            
                                <label for="lup_type">Select Change Related to</label>
                                
                                @include('lup.modal.add.luptype')
                              </div>
                            </div>             
                            
                            <div class="col-md-4 mb-2">
                              <div class="form-input input-sm">
                                <button href="#" class="btn btn-primary text-white edit" data-bs-toggle="modal" data-bs-target="#modaleditlupsubtype" title="Edit Action Plan"><i class="ri-edit-2-fill"></i></button>                                                                                                                          
                                <label for="lup_type">Select Change Sub Category</label>                                
                              </div>
                            </div> 
                      </div>  
                      <div class="col-md-12 mb-2">
                        <div class="form-floating input-sm mt-2">
                          <input type="text" class="form-control text-small" name="lup_type_others" id="lup_type_others" placeholder="If Others (Specify)" value = "{{ old('lup_type_others') }}" autocomplete="off" >
                          <label for="lup_type_others">If Others (Specify)</label>
                          @error('lup_type_others')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror 
                        </div>
                      </div>      
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                  <div class="form-floating input-sm">
                                      <select class="form-select" @error('duedate_type') is-invalid @enderror name="duedate_type" id="duedate_type" aria-label="Change Type" required autocomplete="off" >                                
                                          <option value="Permanent">Permanent</option>
                                          <option value="Temporary">Temporary</option>                                
                                        </select>                            
                                    <label for="duedate_type">Change Type</label>
                                    @error('duedate_type')
                                      <div class="text-danger">{{ $message }}</div>
                                    @enderror 
                                  </div>
                                </div>
                                    <div class="col-md-4 mb-2">                  
                                      <div class="form-floating">
                                        <input type="date" class="form-control text-small" name="duedate_start" id="duedate_start" placeholder="Due Date Implementation" value="{{ old('duedate_start') }}" required autocomplete="off" >
                                        <label for="duedate_start" @error('duedate_start') is-invalid @enderror id="labelfor_duedate_start">Due Date Implementation</label>
                                        @error('duedate_start')
                                          <div class="text-danger">{{ $message }}</div>
                                        @enderror 
                                      </div>                 
                                    </div>    
                                    <div class="col-md-4 mb-2">                  
                                      <div class="form-floating">
                                        <input type="date" class="form-control text-small" @error('duedate_finish') is-invalid @enderror name="duedate_finish" id="duedate_finish" placeholder="Due Date Finish" value="{{ old('duedate_finish') }}" autocomplete="off" >
                                        <label for="duedate_finish">Due Date Finish</label>
                                        @error('duedate_finish')
                                          <div class="text-danger">{{ $message }}</div>
                                        @enderror 
                                      </div>                 
                                    </div>     
                            </div>
                        <div class="row">
                          <div class="col-sm-4 mb-2">         
                            <label class="form-check-label mb-2" id="lup_current" name="lup_current">Current Condition :</label>               
                            <div class="form-floating">
                                <label for="lup_current">Current Condition</label>
                                <textarea  placeholder="Fill Current Condition" @error('lup_current') is-invalid @enderror name="lup_current" id="lup_current" required minlength="10" maxlength="2000" autocomplete="off" >
                                    {{ old('lup_current') }}
                                  </textarea><!-- End TinyMCE Editor -->  
                              @error('lup_current')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror                         
                              
                            </div>
                          </div>
                          <div class="col-sm-4 mb-2">         
                            <label class="form-check-label mb-2" id="lup_proposed" name="lup_proposed">Proposed :</label>               
                            <div class="form-floating">
                                <label for="lup_proposed">Proposed</label>
                                <textarea placeholder="Fill Proposed Change" @error('lup_proposed') is-invalid @enderror name="lup_proposed" id="lup_proposed" required minlength="10" maxlength="2000" autocomplete="off" >
                                    {{ old('lup_proposed') }}
                                  </textarea><!-- End TinyMCE Editor -->         
                              @error('lup_proposed')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror                  
                              
                            </div>
                          </div>
                          <div class="col-sm-4 mb-2">         
                            <label class="form-check-label mb-2" id="lup_reason" name="lup_reason">Change Reason :</label>               
                            <div class="form-floating">
                                <label for="lup_reason">Change Reason</label>
                                <textarea placeholder="Fill Change Reason"  @error('lup_reason') is-invalid @enderror name="lup_reason" id="lup_reason" required minlength="10" maxlength="2000" autocomplete="off" >
                                    {{ old('lup_reason') }}
                                  </textarea><!-- End TinyMCE Editor -->     
                              @error('lup_reason')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror                      
                              
                            </div>
                          </div>  
                        </div>         
                    </form>         
                  </div>           <!-- End Details Form -->        
            </div>         
  
            </div><!-- End Bordered Tabs -->  
          </div>
        </div>
  
      </div>
    </div>
  </section>
</div><!-- End Page Title -->


@stop
