@extends('layouts.admin.master')

@section('title', 'Dashboard')
@section('content')
<div class="pagetitle">
  <h3 class="font-dark">Welcome Back, {{Auth::user()->name}} <i class="fa fa-heart font-danger"></i></h3>
    <p>Welcome to the {{env('APP_NAME')}} Family ! We are glad that you are visite this dashboard. we will be happy to help you accelerate your business.</p>
  @component('components.breadcrumb')
		@slot('breadcrumb_title')
    
		@endslot       
  @endcomponent
</div><!-- End Page Title -->
<div class="card-body text-center p-t-0">
  
  {{-- <button class="btn btn-light">Update</button> --}}
</div>
        <!-- Left side columns -->
        <div class="col-8">
          
            {{-- @include('dashboard.lup')
            @include('dashboard.lupd')
            @include('dashboard.flp')
            @include('dashboard.chart') --}}
         
        </div><!-- End Left side columns -->
      
        <!-- Right side columns -->
        <div class="col-4">  
          {{-- @include('dashboard.right_chart') --}}
        </div>
      
      
    
      
<div class="scroll-left">
  <p>{!!$quotes!!}</p>  
</div>  


@stop
 