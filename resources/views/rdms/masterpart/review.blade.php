@extends('layouts.main')

@section('title', 'Edit Part')

@section('content')
@php
  $id= Crypt::encryptString($masterpart->id);
@endphp

<div class="pagetitle">
     
    <nav style="--bs-breadcrumb-divider: '|';">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
        <li class="breadcrumb-item"><a href="/masterpart">Master Part</a></li>        
        <li class="breadcrumb-item ">Requester : {{ $masterpart->requester_part }}</li>        
        <li class="breadcrumb-item active">
          <a href="#" title="Print FLP" onclick="window.open('/flp//printflp','_blank').focus"><i class="ri-printer-fill"></i></a>
        </li>   
        <li class="breadcrumb-item active">
          <a href="/newpart" title="Create New Part"><i class="ri-add-box-line"></i></a>
        </li>   
        
      </ol>
      <ol class="breadcrumb mt-0">
        <li class="breadcrumb-item ">Part No. : {{ $masterpart->sap_part }}</li>      
        <li class="breadcrumb-item ">Part Desc. : {{ $masterpart->sap_desc }}</li>       
        <li class="breadcrumb-item ">Created Date: @date($masterpart->created_at,'d-M-y')</li>
        <li class="breadcrumb-item ">Input Date: @date($masterpart->sap_date_input,'d-M-y')</li>
      </ol> 
       
      
      
    </nav>

  
  
  <section class="section profile">
    <div class="row">      
        <div class="col-sm">
  
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="PartSAPMenu">  
                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#basicdata" href="#basicdata">Basic</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#stockdata" href="#stockdata">Stock</a>
                </li>   
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#salesdata" href="#salesdata">Sales</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#planningdata" href="#planningdata">Planning</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#sourcingdata" href="#sourcingdata">Sourcing</a>
                </li>                
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#warehousedata" href="#warehousedata">Warehouse</a>
                </li>  
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#qualitydata" href="#qualitydata">Quality</a>
                </li>  
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#costingdata" href="#costingdata">Costing</a>
                </li>  
                <li class="nav-item">  
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#historydata" href="#historydata">History</a>
                </li>  
              </ul>            
              <div class="tab-content pt-2">
                @include('rdms.masterpart.basicdata')         
                @include('rdms.masterpart.stockdata')   
                @include('rdms.masterpart.salesdata')           
                @include('rdms.masterpart.planningdata')           
                @include('rdms.masterpart.sourcingdata')                   
                @include('rdms.masterpart.warehousedata')                       
                @include('rdms.masterpart.qualitydata')                        
                @include('rdms.masterpart.costingdata')                        
                @include('rdms.masterpart.historydata')         
              </div><!-- End Bordered Tabs -->
    
            </div>
          </div>
    
        </div>
    </div>
  </section>
</div><!-- End Page Title -->
                           
   


@stop
