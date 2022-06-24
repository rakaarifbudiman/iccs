@extends('errors.main')
@section('title','Service Unavailable')
@section('code','503')
@section('message', __($exception->getMessage() ?: 'Maintenance'))
@section('content')
        <h2>We're Going Down...</h2>
        <h2>Please wait until this done</h2>    
<img src="/assets/img/not-found.svg" class="img-fluid height:auto" alt="Maintenance">   
@stop