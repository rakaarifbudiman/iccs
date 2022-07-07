@extends('layouts.main')

@section('title', 'Review LUP')

@section('content')

<div class="pagetitle">
    {{-- <h1>Review LUP</h1> --}}    
    <nav style="--bs-breadcrumb-divider: '|';" id="LUPHeader">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
        <li class="breadcrumb-item"><a href="/lup/masterlist">Master List LUP</a></li>
        <li class="breadcrumb-item active">
          <a href="#" title="Print LUP" onclick="window.open('/lup/{{Crypt::encryptString($lupparent->id)}}/printlup','_blank').focus"><i class="ri-printer-fill"></i></a>
        </li> 
        @can('update',$lupparent)
          <li class="breadcrumb-item active">
            <a href="#" onclick="event.preventDefault(); document.getElementById('submit-form').submit();" title="Save">
              <i class="ri-save-3-fill" ></i>
            </a>
          </li>
          <li class="breadcrumb-item active">
            <a class="breadcrumb-item" href="#" data-bs-toggle="modal" data-bs-target="#modaleditcategorization{{$lupparent->id}}">
              <span class="badge bg-info badge-number">Categorization Adjustments ?</span>
            </a>          
          </li>          
        @endcan  
        @can('requestcancel',$lupparent)
          <li class="breadcrumb-item active">
            <a title="Request Cancel LUP" class="breadcrumb-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrequestcancellup{{$lupparent->id}}"><i class="ri-close-circle-line"></i>         
            </a>          
          </li>  
        @endcan   
        @can('rollback',$lupparent)
        <li class="breadcrumb-item active">
          <a title="Rollback to ON REVIEW" class="breadcrumb-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrollbacklup{{$lupparent->id}}"><i class="bi-skip-backward-fill"></i>         
          </a>          
        </li>       
        @endcan         
        <li class="breadcrumb-item active">
          <a href="#" title="Download Regulatory Cheat Sheet" onclick="window.open('/lup/downloadregcheatsheet','_blank').focus"><i class="ri-article-line"></i>            
          </a>          
        </li>    
        <li class="breadcrumb-item active">
          <a href="#" title="Download Tutorial" onclick="window.open('/lup/downloadpanduan','_blank').focus"><i class="ri-book-mark-line"></i>            
          </a>          
        </li>   
      </ol>
      <ol class="breadcrumb mt-0">
        <li class="breadcrumb-item ">Code : {{ $lupparent->code }}</li>
        <li class="breadcrumb-item ">                  
            <a class="breadcrumb-item" href="#" data-bs-toggle="dropdown">Status : {{ $lupparent->lupstatus }}
              <span class="badge bg-info badge-number">?</span>
            </a><!-- End Messages Icon -->        
              <ul class="dropdown-menu dropdown-menu-arrow messages">                
                <li class="badge bg-dark badge-number">
                  CREATE      : LUP created and waiting for leader approval<br>
                  ON PROCESS  : LUP being review by QSE <br>
                  ON REVIEW   : LUP being review by Related Departments <br>
                  ON APPROVAL : LUP being review by QCJM <br>
                  APPROVED    : LUP has been approved , received No LUP, and waiting for fill action plan <br>
                  OPEN        : LUP has been confirmed by QCJM and waiting PIC action to close their action <br>
                  ON CANCEL   : LUP has been request for cancellation and being review by QSE <br>    
                  ON CANCEL APPROVAL   : LUP has been request for cancellation and being review by QCJM <br>     
                  ON CLOSING   : LUP has been request for closing and being review by QCJM <br>    
                  CLOSED   : LUP has been CLOSED, no need further action <br>  
                  CANCEL   : LUP has been CANCEL, no need further action <br> 
                               
                </li>                
              </ul><!-- End Messages Dropdown Items -->         
        </li>
        <li class="breadcrumb-item active">No. LUP : {{ $lupparent->nolup }}</li>
        <li class="breadcrumb-item active">Rev : {{ $lupparent->revision }}</li>
        <li class="breadcrumb-item ">Created Date: @date($lupparent->date_input,'d-M-Y')</li>
      </ol>      
    </nav>

  
    <form id="submit-form" action="/lup/{{ $lupparent->id }}/update" method="POST" class="hidden">
      @csrf    
      @method('Put')
  <section class="section profile">
    <div class="row">      
        <div class="col-sm">
  
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" id="LUPMenu">  
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#initiation">Change Initiation</a>
              </li>   
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#categorization">Change Categorization</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#attachments">Attachments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments">Related Departments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#approval">Approvals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#action">Action Plan</a>
              </li>   
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#history">History</a>
              </li>  
            </ul>            
            <div class="tab-content pt-2">
                  <div class="tab-pane fade initiation pt-3" id="initiation">  <!-- Details Form -->                
                    <div class="row">                      
                          <div class="col-md-12 mb-2">
                            <div class="form-floating">
                              <input type="text" class="form-control" @error('documentname') is-invalid @enderror name="documentname" id="documentname" placeholder="Title" value = "{{ old('documentname',$lupparent->documentname) }}" required autofocus autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                              <label for="documentname">Title</label>
                            </div>
                          </div>
                          <div class="col-md-11 mb-2">
                            <div class="form-floating input-sm">
                              <textarea style="height: 100px" type="text" class="form-control text-small" min-height ="100"name="lup_type" id="lup_type" placeholder="Change Related to" autocomplete="off" disabled>{{ $lupparent->lup_type }}</textarea>
                              <label for="lup_type">Change Related to</label>                              
                              @error('lup_type')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror 
                            </div>                            
                          </div>     
                          <div class="col-md-1 mb-2">
                            <div class="form-floating input-sm">
                              <button href="#" class="btn btn-primary text-white edit" data-bs-toggle="modal" data-bs-target="#modaleditluptype" title="Edit Action Plan"><i class="ri-edit-2-fill"></i></button>                                                                                            
                              @include('lup.modal.edit.luptype')
                            </div>
                          </div>                                          
                          <div class="col-md-11 mb-2">
                            <div class="form-floating input-sm">
                              <textarea style="height: 100px"type="text" class="form-control text-small" name="lup_subtype" id="lup_subtype" placeholder="Change Sub Category" autocomplete="off" disabled>{{ old('lup_subtype',$lupparent->lup_subtype) }}</textarea>
                              <label for="lup_subtype">Change Sub Category</label>
                            </div>
                          </div>
                          <div class="col-md-1 mb-2">
                            <div class="form-floating input-sm">
                              <button href="#" class="btn btn-primary text-white edit" data-bs-toggle="modal" data-bs-target="#modaleditlupsubtype" title="Edit Action Plan"><i class="ri-edit-2-fill"></i></button>                                                                                                                          
                            </div>
                          </div>   
                          <div class="col-md-12 mb-2">
                            <div class="form-floating input-sm mt-2">
                              <input type="text" class="form-control text-small" name="lup_type_others" id="lup_type_others" placeholder="If Others (Specify)" value = "{{ old('lup_type_others',$lupparent->lup_type_others) }}" autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                              <label for="lup_type_others">If Others (Specify)</label>
                              @error('lup_type_others')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror 
                            </div>
                          </div>      
                          <div class="col-md-4 mb-2">
                            <div class="form-floating input-sm">
                                <select class="form-select" @error('duedate_type') is-invalid @enderror name="duedate_type" id="duedate_type" aria-label="Change Type" required autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                    <option selected value="{{ $lupparent->duedate_type }}">{{ old('duedate_type',$lupparent->duedate_type) }}</option>
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
                                  <input type="date" class="form-control text-small" name="duedate_start" id="duedate_start" placeholder="Due Date Implementation" value="@date($lupparent->duedate_start,'Y-m-d')" required autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                  <label for="duedate_start" @error('duedate_start') is-invalid @enderror id="labelfor_duedate_start">Due Date Implementation (@date($lupparent->duedate_start,'d-M-Y'))</label>
                                  @error('duedate_start')
                                    <div class="text-danger">{{ $message }}</div>
                                  @enderror 
                                </div>                 
                              </div>    
                              <div class="col-md-4 mb-2">                  
                                <div class="form-floating">
                                  <input type="date" class="form-control text-small" @error('duedate_finish') is-invalid @enderror name="duedate_finish" id="duedate_finish" placeholder="Due Date Finish" value="@date($lupparent->duedate_finish,'Y-m-d')" autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                  <label for="duedate_finish">Due Date Finish (@date($lupparent->duedate_finish,'d-M-Y'))</label>
                                  @error('duedate_finish')
                                    <div class="text-danger">{{ $message }}</div>
                                  @enderror 
                                </div>                 
                              </div>     
                            <div class="row">
                              <div class="col-sm-4 mb-2">         
                                <label class="form-check-label mb-2" id="lup_current" name="lup_current">Current Condition :</label>               
                                <div class="form-floating">
                                    <label for="lup_current">Current Condition</label>
                                    <textarea  placeholder="Fill Current Condition" @error('lup_current') is-invalid @enderror name="lup_current" id="lup_current" required minlength="10" maxlength="2000" autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                        {{ old('lup_current',$lupparent->lup_current) }}
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
                                    <textarea placeholder="Fill Proposed Change" @error('lup_proposed') is-invalid @enderror name="lup_proposed" id="lup_proposed" required minlength="10" maxlength="2000" autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                        {{ old('lup_proposed',$lupparent->lup_proposed) }}
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
                                    <textarea placeholder="Fill Change Reason"  @error('lup_reason') is-invalid @enderror name="lup_reason" id="lup_reason" required minlength="10" maxlength="2000" autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                        {{ old('lup_reason',$lupparent->lup_reason) }}
                                      </textarea><!-- End TinyMCE Editor -->     
                                  @error('lup_reason')
                                    <div class="text-danger">{{ $message }}</div>
                                  @enderror                      
                                  
                                </div>
                              </div>  
                            </div>                        
                      </div>                            
                  </div>           <!-- End Details Form -->                     
                  @include('lup.review.categorization')   
                  @include('lup.review.attachments')    
                  @include('lup.review.department')   
                  @include('lup.review.approval')
                  @include('lup.review.action')   
                  @include('lup.review.history')      
            </div>              
  
            </div><!-- End Bordered Tabs -->
  
          </div>
        </div>
  
      </div>
    </div>
  </section>
</form> 
@include('lup.modal.edit.categorization')
</div><!-- End Page Title -->


@stop
