@extends('errors.main')
@section('title','Forbidden')
@section('code','403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('content')        
<h2><a class="btn" href="{{ url()->previous() }}">Go Back</a>      
        OR 
<a class="btn" href="/">Go Home</a>    </h2>
<img src="/assets/img/not-found-2.png" class="img-fluid height:auto" alt="Forbidden">
@stop


