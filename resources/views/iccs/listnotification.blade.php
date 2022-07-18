@extends('layouts_old.main')

@section('title', 'List Notification')

@section('content')

<div class="pagetitle">
  <h1>List Notification</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
      <li class="breadcrumb-item active">List Notification</li>
    </ol>
  </nav>
</div><!-- End Page Title  -->
  <section class="section dashboard">
  <div class="row">
    <div class="card">
      <div class="card-body">       
        <div class="table-responsive text-nowrap">
            <table class="table datatable w-auto small" id="LUPTable"> 
            <thead>    
                <tr>
                    <th scope="col"> No. </th>
                    <th scope="col">Operation</th>
                    <th scope="col">Date</th>
                    <th scope="col">Subject</th>                    
                                  
                </tr>
              </thead>
              <tbody>
                @foreach ($emaillogs as $index =>$log)                 
                  <tr>
                      <th scope="row">{{ $index +1 }}</th> 
                      <td>                     
                        <a href="#" class="btn btn-sm btn-success text-white" data-bs-toggle="modal" data-bs-target="#modalnotification{{ $log->id }}" title="View Notification" 
                            ><i class="ri-add-fill"></i>
                        </a>  
                    </td>                     
                      <td>@date($log->date,'d-M-Y H:i')</td>  
                      <td>{{ $log->subject }}</td>                                                
                  </tr>   
                  @include('iccs.modalnotification')          
                @endforeach
                  </tbody>
                </table>        
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
                    
                            
                    
                    
                    


