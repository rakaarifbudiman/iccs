@extends('layouts.main')

@section('title', 'New Part')

@section('content')
<div class="pagetitle">
     
    <nav style="--bs-breadcrumb-divider: '|';">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
        <li class="breadcrumb-item"><a href="/masterpart">Master Part</a></li>        
        <li class="breadcrumb-item ">Requester : </li>        
        <li class="breadcrumb-item active">
          <a href="#" title="Print FLP" onclick="window.open('/flp//printflp','_blank').focus"><i class="ri-printer-fill"></i></a>
        </li>          
        
      </ol>
      <ol class="breadcrumb mt-0">
        <li class="breadcrumb-item ">Part No. :</li>      
        <li class="breadcrumb-item ">Part Desc. : </li>       
        <li class="breadcrumb-item ">Created Date:</li>
        <li class="breadcrumb-item ">Input Date:</li>
      </ol> 
       
      
      
    </nav>

  
  
  <section class="section profile">
    <div class="row">      
        <div class="col-sm">
  
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="tabMenu">  
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basicdata">Basic</button>
                </li>                  
              </ul>            
              <div class="tab-content pt-2">
                @include('rdms.masterpart.newbasic')         
                     
              </div><!-- End Bordered Tabs -->
    
            </div>
          </div>
    
        </div>
    </div>
  </section>
</div><!-- End Page Title -->
                           
   


@stop
