@extends('layouts.admin.master')

@section('title', 'Review FLP')

@section('content')
@php
  $id= Crypt::encryptString($flp->id);
@endphp

<div class="pagetitle">
  @component('components.breadcrumb')
        @slot('breadcrumb_title')
          <h3>Review FLP</h3>
        @endslot  
          <li class="breadcrumb-item"><a href="/flp/masterlist">Master List FLP</a></li>            
          <li class="breadcrumb-item active ">Code : {{ $flp->code }}</li>
          <li class="breadcrumb-item">    Status : {{ $flp->lupstatus }}</li> 
          <li class="breadcrumb-item active">No. FLP : {{ $flp->nolup }}</li>
          <li class="breadcrumb-item active">Rev : {{ $flp->revision }}</li>
          <li class="breadcrumb-item active">Created Date: @date($flp->date_input,'d-M-Y')</li>        
        @slot('bookmark')
                      <li><a href="#" data-container="body" data-bs-toggle="popover" data-placement="top" title="Print FLP" data-original-title="Tables" 
                        onclick="window.open('/flp/{{Crypt::encryptString($flp->id)}}/printflp','_blank').focus"><i data-feather="printer"></i></a>
                      </li>
                        @can('update',$flp)
                          <li><a href="#" data-container="body" data-bs-toggle="popover" data-placement="top" title="Save" data-original-title="Save" 
                            onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i data-feather="save"></i></a></li>                                         
                        @endcan
                        @can('requestcancel',$flp)
                          <li>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalrequestcancelflp{{$flp->id}}"
                              data-placement="top" title="Cancel FLP" data-original-title="Cancel FLP"><i data-feather="x-circle"></i>         
                            </a>          
                          </li>  
                        @endcan   
                      @can('rollback',$flp)
                      <li>
                        <a title="Rollback to ON REVIEW" class="breadcrumb-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrollbackflp{{$flp->id}}"
                          data-placement="top" data-original-title="Rollback"><i data-feather="refresh-ccw"></i>         
                        </a>          
                      </li>       
                      @endcan                        
                      <li>
                        <a href="#" title="Download Tutorial" onclick="window.open('/lup/downloadpanduan','_blank').focus"
                        data-placement="top" data-original-title="Download Tutorial"><i data-feather="help-circle"></i>            
                        </a>          
                      </li>            
                      
        @endslot
  @endcomponent

  
  
  <section class="section profile">
    <div class="row">      
        <div class="col-sm">  
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" id="FLPMenu">  
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#details"><i class="fa fa-home"></i>Details Product</a>
              </li>   
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#actionplans"><i class="fa fa-tasks"></i>Action Plan</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#attachments"><i class="fa fa-file"></i>Attachments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#approval"><i class="fa fa-check-square-o"></i>Approval</a>
              </li>  
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#history"><i class="fa fa-history"></i>History</a>
              </li>  
            </ul>            
            <div class="tab-content pt-2">
                  <div class="tab-pane fade details pt-3" id="details">  <!-- Details Form -->                
                    <form class="row g-3" method="POST" action="/flp/{{ $flp->id }}/update" id="submit-form">
                      @csrf
                      @method('put')
                      <div class="col-md-12">
                        <div class="form-floating input-sm">
                          <input type="text" class="form-control" name="documentname" id="documentname" placeholder="Product Name" value = "{{ old('documentname',$flp->documentname) }}" required autofocus autocomplete="off">
                          <label for="documentname">Product Name</label>
                            @error('documentname')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Active Ingredients" name="ingredients" id="ingredients" style="height: 100px;" required autocomplete="off">{{ $flp->ingredients }}</textarea>
                          <label for="ingredients">Active Ingredients</label>
                            @error('ingredients')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="dosageform" id="dosageform" placeholder="Dosage Forms" value="{{ old('dosageform',$flp->dosageform)}}" required autocomplete="off">
                          <label for="dosageform">Dosage Forms</label>
                            @error('dosageform')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="packaging" id="packaging" placeholder="Packaging" value="{{ old('packaging',$flp->packaging)}}" required autocomplete="off">
                          <label for="packaging">Packaging</label>
                            @error('packaging')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="regno" id="regno" placeholder="Registration No." value="{{ old('regno',$flp->regno)}}" required autocomplete="off">
                            <label for="regno">Registration No.</label>
                            @error('regno')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating mb-3">
                          <select class="form-select" name="bussinessunit" id="bussinessunit" aria-label="Bussiness Unit" required autocomplete="off">
                            <option value="{{ $flp->bussinessunit }}">{{ $flp->bussinessunit }}</option>
                            @include('flp.new.listbussinessunit')
                          </select>
                          <label for="bussinessunit">Bussiness Unit</label>
                            @error('bussinessunit')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="het" id="het" placeholder="het" value="{{ old('het',$flp->het)}}" required autocomplete="off">
                          <label for="het">HET</label>
                          @error('het')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                      </div>
                      <div class="col-md-4">                  
                          <div class="form-floating">
                            <input type="date" class="form-control" name="duedate_start" id="duedate_start" placeholder="Launch Date" value="@date($flp->duedate_start,'Y-m-d')" required autocomplete="off">
                            <label for="duedate_start">Launch Date </label>
                            @error('duedate_start')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror 
                          </div>                 
                      </div>                
                      <div class="col-12">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Notes" name="notes" id="notes" style="height: 100px;">{{ $flp->notes }}</textarea>
                          <label for="notes">Notes</label>                            
                        </div>
                      </div>   
                      
                    </form>         
                  </div>           <!-- End Details Form -->    
                  @include('flp.review.actionplan')
                  @include('flp.review.attachments')
                  @include('flp.review.approval')
                  @include('flp.review.history')
            </div>
            </div><!-- End Bordered Tabs -->
  
          </div>
        </div>
  
      </div>
    </div>
  </section>
</div><!-- End Page Title -->


@stop
