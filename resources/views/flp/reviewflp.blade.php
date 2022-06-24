@extends('layouts.main')

@section('title', 'Review FLP')

@section('content')
@php
  $id= Crypt::encryptString($flp->id);
@endphp

<div class="pagetitle">
    {{-- <h1>Review FLP</h1> --}}    
    <nav style="--bs-breadcrumb-divider: '|';">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
        <li class="breadcrumb-item"><a href="/flp">Master List FLP</a></li>        
        <li class="breadcrumb-item ">Inisiator : {{ $inisiatorcomplete }}</li>
        <li class="breadcrumb-item ">Action : {{ $actioncomplete }}</li>
        <li class="breadcrumb-item active">
          <a href="#" title="Print FLP" onclick="window.open('/flp/{{$id}}/printflp','_blank').focus"><i class="ri-printer-fill"></i></a>
        </li>   
        
      </ol>
      <ol class="breadcrumb mt-0">
        <li class="breadcrumb-item ">Code : {{ $flp->code }}</li>
        <li class="breadcrumb-item ">Status : {{ $flp->flpstatus }}</li>
        <li class="breadcrumb-item active">No. FLP : {{ $flp->noflp }}</li>
        <li class="breadcrumb-item active">Rev : {{ $flp->revision }}</li>
        <li class="breadcrumb-item ">Created Date: @date($flp->date_input,'d-M-Y')</li>
      </ol>      
       
      
      
    </nav>

  
  
  <section class="section profile">
    <div class="row">      
        <div class="col-sm">
  
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" id="FLPMenu">  
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#details">Details Product</a>
              </li>   
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#actionplans">Action Plan</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#attachments">Attachments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#approval">Approval</a>
              </li>  
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#history">History</a>
              </li>  
            </ul>            
            <div class="tab-content pt-2">
                  <div class="tab-pane fade details pt-3" id="details">  <!-- Details Form -->                
                    <form class="row g-3" method="POST" action="/flp/{{ $flp->id }}/update">
                      @csrf
                      @method('put')
                      <div class="col-md-12">
                        <div class="form-floating input-sm">
                          <input type="text" class="form-control" name="documentname" id="documentname" placeholder="Product Name" value = "{{ old('documentname',$flp->documentname) }}" required autofocus autocomplete="off">
                          <label for="documentname">Product Name</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Active Ingredients" name="ingredients" id="ingredients" style="height: 100px;" required autocomplete="off">{{ $flp->ingredients }}</textarea>
                          <label for="ingredients">Active Ingredients</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="dosageform" id="dosageform" placeholder="Dosage Forms" value="{{ old('dosageform',$flp->dosageform)}}" required autocomplete="off">
                          <label for="dosageform">Dosage Forms</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="packaging" id="packaging" placeholder="Packaging" value="{{ old('packaging',$flp->packaging)}}" required autocomplete="off">
                          <label for="packaging">Packaging</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="regno" id="regno" placeholder="Registration No." value="{{ old('regno',$flp->regno)}}" required autocomplete="off">
                            <label for="regno">Registration No.</label>
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
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="het" id="het" placeholder="het" value="{{ old('het',$flp->het)}}" required autocomplete="off">
                          <label for="het">HET</label>
                        </div>
                      </div>
                      <div class="col-md-4">                  
                          <div class="form-floating">
                            <input type="date" class="form-control" name="launch" id="launch" placeholder="Launch Date" value="@date($flp->launch,'Y-m-d')" required autocomplete="off">
                            <label for="launch">Launch Date </label>
                            @error('launch')
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
                      @if($flp->flpstatus=="OPEN" OR $flp->flpstatus=="CLOSED") 
                      @else         
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Save</button>                        
                      </div>
                      @endif
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
