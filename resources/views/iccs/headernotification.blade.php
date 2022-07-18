@extends('layouts_old.main')

@section('title', 'List Notification')

@section('content')
<section class="section dashboard">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Notification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>             
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="subject" class="col-sm col-form-label col-form-label-sm">Subject</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="subject" name="subject" value="{{ $log->subject }}" readonly>                                                 
            </div>                                 
          </div>  
          <div class="row mb-3">
            <label for="body" class="col-sm col-form-label col-form-label-sm">Detail</label>            
            <textarea style="min-height: 300px" name="body" id="body" readonly>{!! $log->body !!}</textarea>                               
          </div> 
          
          <input class="form-control form-control-sm" type="text" id="modalhideid" name="modalhideid" value="{{ $log->id }}" hidden>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>          
        </div>      
      </div>
    </section>
    @stop
          
          
          
               
           