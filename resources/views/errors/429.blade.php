@extends('errors.main')
@section('title','Too Many Request')
@section('code','429')
@section('message', __($exception->getMessage() ?: 'Too Many Request'))
@section('content')        
<h2>You have too many request attempts </h2>
<h2>Try again in a minute</h2>
<h2><a class="btn" href="/">Go Back</a></h2>        
<img src="/assets/img/not-found-2.png" class="img-fluid height:auto" alt="Too Many Request">
@stop