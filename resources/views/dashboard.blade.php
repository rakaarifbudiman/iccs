@extends('layouts.main')

@section('title', 'Dashboard')
@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-xxl-8">
      <div class="row">
        @include('dashboard.lup')
        @include('dashboard.lupd')
        @include('dashboard.flp')
        @include('dashboard.chart')
      </div>
    </div><!-- End Left side columns -->
   
    <!-- Right side columns -->
    <div class="col-lg-4">  
      @include('dashboard.right_chart')
    </div>
  
  </div>
</section>          
<div class="scroll-left">
  <p>{{$quotes}}</p>  
</div>  


@stop
 