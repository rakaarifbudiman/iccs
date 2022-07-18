@extends('layouts_old.main')

@section('title', 'Dashboard')
@section('content')
<div class="pagetitle">
  <h1>PHP Version</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
  <div class="row">    
    
        @php
            phpinfo();
        @endphp

      
   
    
  
  </div>
</section>          
  


@stop
 