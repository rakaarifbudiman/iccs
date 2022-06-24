@extends('layouts.main')

@section('title', 'List FLP ICCS')

@section('content')

<div class="pagetitle">
  <h1>List FLP ICCS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
      <li class="breadcrumb-item active">List FLP ICCS</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
  <section class="section dashboard">
  <div class="row">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table datatable w-auto small" id="FLPTable">
            <thead>    
                <tr>
                    <th scope="col"> No. </th>
                    <th scope="col">Operation</th>
                    <th scope="col">Status</th>
                    <th scope="col">Code</th>               
                    <th scope="col">No. FLP</th>                    
                    <th scope="col">Action</th>
                    <th scope="col">PIC Action</th>
                    <th scope="col">Due Date Action</th>
                    <th scope="col">Status Action</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Ingredients</th>
                    <th scope="col">Dosage Form</th>
                    <th scope="col">Bussiness Unit</th>                
                    <th scope="col">Packaging</th>
                    
                    
                </tr>
              </thead>
              <tbody>

                @foreach ($flpparents as $index =>$flpparent)            
                
                <tr>
                    <th scope="row">{{ $index +1 }}</th>
                    <td>
                      @php                    
                        $id= Crypt::encryptString($flpparent->flp_id);                       
                        $i=$index;
                      @endphp
                      
                        <a href="/flp/{{$id}}/edit" class="btn btn-sm btn-primary edit" title="Edit FLP"
                          ><i class="ri-edit-2-fill"></i></a>
                        <a href="#" class="btn btn-sm bg-secondary text-light print" title="print FLP"
                          onclick="window.open('/flp/{{$id}}/printflp','_blank').focus"><i class="ri-printer-fill"></i></a>
                    </td>
                    <td>{{ $flpparent->flpstatus }}</td>  
                    <td>{{ $flpparent->flp_code }}</td>
                    <td>{{ $flpparent->noflp }}</td>                     
                    <td>{{ $flpparent->action }}</td>  
                    <td>{{ $flpparent->pic_action }}</td>                      
                    <td>@date($flpparent->duedate_action,'d-M-y')</td> 
                    <td class="{{$statusaction[$i]=='OVERDUE' ? "bg-danger text-white" : 
                      ($statusaction[$i]=='CLOSED' ? "bg-success text-white" : 
                      ($statusaction[$i]=='ON EXTENSION' ? "bg-primary text-white" :
                      ""))
                    }}">{{$statusaction[$i]}}</td>                    
                    <td>{{ $flpparent->documentname }}</td>
                    <td>{{ $flpparent->ingredients }}</td>
                    <td>{{ $flpparent->dosageform }}</td>
                    <td>{{ $flpparent->bussinessunit }}</td>                 
                    <td>{{ $flpparent->packaging }}</td>
                    
                    
                            
                    
                    
                    
                </tr>         
                  
            
                @endforeach
                </tbody>
              </table>        
        </div>
      </div>
    </div>
  </div>

</section>

@stop

