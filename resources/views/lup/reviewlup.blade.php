@extends('layouts.admin.master')

@section('title', 'Review LUP')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/select2.css') }}">
@endpush
@section('content')

<div class="pagetitle mt-0">
  @component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Review LUP</h3>
		@endslot  
        <li class="breadcrumb-item"><a href="/lup/masterlist">Master List LUP</a></li>
        
        <li class="breadcrumb-item active ">Code : {{ $lupparent->code }}</li>
      <li class="breadcrumb-item">    Status : {{ $lupparent->lupstatus }}</li> 
        {{-- <ul class="card-body dropdown-basic">       
            <ul class="dropdown">
              <a class="breadcrumb-item" >
                Status : {{ $lupparent->lupstatus }} <span><i class="icofont icofont-arrow-down"></i></span>
              </a>
              <li class="dropdown-content">
                <a href="#">CREATE      : LUP created and waiting for leader approval</a>
                <a href="#">ON PROCESS  : LUP being review by QSE </a>
                <a href="#">ON REVIEW   : LUP being review by Related Departments </a>
                <a href="#">ON APPROVAL : LUP being review by QCJM </a>
                <a href="#">APPROVED    : LUP has been approved , received No LUP, and waiting for fill action plan  </a>
                <a href="#">OPEN        : LUP has been confirmed by QCJM and waiting PIC action to close their action </a>
                <a href="#">ON CANCEL   : LUP has been request for cancellation and being review by QSE </a>
                <a href="#">ON CANCEL APPROVAL   : LUP has been request for cancellation and being review by QCJM</a>
                <a href="#">ON CLOSING   : LUP has been request for closing and being review by QCJM </a>
                <a href="#">CLOSED   : LUP has been CLOSED, no need further action </a>
                <a href="#">CANCEL   : LUP has been CANCEL, no need further action</a>
              </li>
            </ul>   
        </ul>     --}}
           
      
  <li class="breadcrumb-item active">No. LUP : {{ $lupparent->nolup }}</li>
  <li class="breadcrumb-item active">Rev : {{ $lupparent->revision }}</li>
  <li class="breadcrumb-item active">Created Date: @date($lupparent->date_input,'d-M-Y')</li>

@slot('bookmark')
              <li><a href="#" data-container="body" data-bs-toggle="popover" data-placement="top" title="Print LUP" data-original-title="Tables" 
                onclick="window.open('/lup/{{Crypt::encryptString($lupparent->id)}}/printlup','_blank').focus"><i data-feather="printer"></i></a>
              </li>
                @can('update',$lupparent)
                  <li><a href="#" data-container="body" data-bs-toggle="popover" data-placement="top" title="Save" data-original-title="Save" 
                    onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i data-feather="save"></i></a></li>
                  <li><a href="#" data-container="body" data-bs-toggle="modal" data-placement="top" title="Categorization Adjustments ?" data-original-title="Categorization Adjustments ?" 
                    data-bs-target="#modaleditcategorization{{$lupparent->id}}"><i data-feather="command"></i></a></li>                      
                @endcan
                @can('requestcancel',$lupparent)
                  <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalrequestcancellup{{$lupparent->id}}"
                      data-placement="top" title="Cancel LUP" data-original-title="Cancel LUP"><i data-feather="x-circle"></i>         
                    </a>          
                  </li>  
                @endcan   
              @can('rollback',$lupparent)
              <li>
                <a title="Rollback to ON REVIEW" class="breadcrumb-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrollbacklup{{$lupparent->id}}"
                  data-placement="top" data-original-title="Rollback"><i data-feather="refresh-ccw"></i>         
                </a>          
              </li>       
              @endcan  
              <li>
                <a href="#" title="Download Regulatory Cheat Sheet" onclick="window.open('/lup/downloadregcheatsheet','_blank').focus"
                data-placement="top" data-original-title="Download Regulatory Cheat Sheet"><i data-feather="layers"></i>            
                </a>          
              </li>    
              <li>
                <a href="#" title="Download Tutorial" onclick="window.open('/lup/downloadpanduan','_blank').focus"
                data-placement="top" data-original-title="Download Tutorial"><i data-feather="help-circle"></i>            
                </a>          
              </li>            
              
@endslot
	@endcomponent
    
    <form id="submit-form" action="/lup/{{ $lupparent->id }}/update" method="POST" class="hidden">
      @csrf    
      @method('Put')
  
          <div class="card">
            <div class="card-body">                               
                  <ul class="nav nav-tabs mt-0" id="LUPMenu">  
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#initiation" role="tab" aria-controls="initiation">
                        <i class="fa fa-home"></i>Change Initiation</a>
                    </li>   
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#categorization" role="tab" aria-controls="categorization" >
                        <i class="fa fa-gavel"></i>Change Categorization</a>
                    </li> 
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#attachments" role="tab" aria-controls="attachments">
                        <i class="fa fa-file"></i>Attachments</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#departments" role="tab" aria-controls="departments">
                        <i class="fa fa-users"></i>Related Departments</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#approval" role="tab" aria-controls="approval">
                        <i class="fa fa-check-square-o"></i>Approvals</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#action" role="tab" aria-controls="action">
                        <i class="fa fa-tasks"></i></i>Action Plan</a>
                    </li>   
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#history" role="tab" aria-controls="history">
                        <i class="fa fa-history"></i>History</a>
                    </li>  
                  </ul>            
                  <div class="tab-content pt-3">
                        <div class="tab-pane fade initiation pt-0" id="initiation" >  <!-- Details Form -->                                    
                          <div class="row mt-2">                      
                                <div class="col-md-12 mb-2">
                                  <div class="form-floating">
                                    <input type="text" class="form-control" @error('documentname') is-invalid @enderror name="documentname" id="documentname" placeholder="Title" value = "{{ old('documentname',$lupparent->documentname) }}" required autofocus autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                    <label for="documentname">Title</label>
                                  </div>
                                </div>
                                <div class="select2-drpdwn">
                                  <div class="mb-5">
                                    <label class="col-form-label" for="lup_type">Change Related to</label>                      
                                        <select class="js-example-basic-multiple col-sm-12" id="lup_type" name="lup_type[]" multiple="multiple" style="width: 175%">
                                          @foreach ($listtypes as $listype)
                                            <option value="{{$listype->luptype}}"
                                              @foreach ($luptypes as $luptype)
                                                {{($listype->luptype==$luptype) ? 'selected' : ''}}
                                              @endforeach
                                              >{{$listype->luptype}}
                                            </option>                                                  
                                          @endforeach
                                        </select>  
                                        @error('lup_type')
                                      <div class="text-danger">{{ $message }}</div>
                                    @enderror                                                                                         
                                  </div>     
                                </div>             
                                <div class="select2-drpdwn">
                                  <div class="mb-5">
                                    <label class="col-form-label" for="lup_type">Change Sub Category</label>                      
                                        <select class="js-example-basic-multiple col-sm-12" id="lup_subtype" name="lup_subtype[]" multiple="multiple" style="width: 175%">
                                          @foreach ($listtypes as $listype)
                                            <optgroup label ="{{$listype->luptype}}">
                                                @foreach ($listsubtypes->where('code',$listype->code) as $listsubtype)
                                                  <option value="{{$listsubtype->luptype}} "
                                                    @foreach ($lupsubtypes as $lupsubtype)
                                                      {{($listsubtype->luptype==$lupsubtype) ? 'selected' : ''}}
                                                    @endforeach
                                                    >{{$listsubtype->luptype}} 
                                                  </option>                                                  
                                                @endforeach
                                            </optgroup>
                                          @endforeach    
                                        </select>                                                                                          
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
                                    <div class="col-sm-6 mb-2">         
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
                                    <div class="col-sm-6 mb-2">         
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
                                    <div class="col-sm-12 mb-2">         
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
              
            </div>
          </div>   
  
</form> 
@include('lup.modal.edit.categorization')
</div><!-- End Page Title -->

@push('scripts')
<script src="{{ asset('/assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('/assets/js/select2/select2-custom.js') }}"></script>
@endpush
@stop
