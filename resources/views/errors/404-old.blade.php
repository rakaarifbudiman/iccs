@extends('errors.main')
@section('title','Not Found')
@section('code','404')
@section('message', __($exception->getMessage() ?: 'Page Not Found'))
@section('content')
        <h2>Looks Like You're Lost...</h2>
        <h2>Stay Where You're and We'll Send Someone to Find You</h2>
  <h2><a class="btn" href="{{ url()->previous() }}">Go Back</a>      
          OR 
  <a class="btn" href="/">Go Home</a>    </h2> 
  <img src="/assets/img/not-found.svg" class="img-fluid height:auto" alt="Page Not Found">     
@stop


