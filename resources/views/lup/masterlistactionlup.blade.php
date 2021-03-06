@extends('layouts.main')

@section('title', 'List LUP ICCS')

@section('content')

<div class="pagetitle">
  <h1>List LUP ICCS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
      <li class="breadcrumb-item active">List LUP ICCS</li>
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
                    <th scope="col">Status</th>                                   
                    <th scope="col">No. LUP</th>                    
                    <th scope="col">Action</th>
                    <th scope="col">PIC Action</th>
                    <th scope="col">Due Date Action</th>
                    <th scope="col">Status Action</th>
                    <th style="width: 1px !important;">Title</th>                    
                    <th scope="col">Proposed Change</th>
                                
                    
                    
                    
                </tr>
              </thead>
              <tbody>

                @foreach ($lupparents as $index =>$lupparent)            
                
                <tr>
                    <th scope="row">{{ $index +1 }}</th>
                    <td>                     
                        <a href="/lup/{{Crypt::encryptString($lupparent->lup_id)}}/edit" class="btn btn-sm btn-primary edit" title="Edit LUP"
                          ><i class="ri-edit-2-fill"></i></a>
                        <a href="#" class="btn btn-sm bg-secondary text-light print" title="print LUP"
                          onclick="window.open('/lup/{{Crypt::encryptString($lupparent->lup_id)}}/printlup','_blank').focus"><i class="ri-printer-fill"></i></a>
                    </td>
                    <td>{{ $lupparent->lupstatus }}</td>                    
                    <td>{{ $lupparent->nolup }}</td>                     
                    <td class="setwidth"><textarea  readonly>{{ $lupparent->action }}</textarea></td>  
                    <td>{{ $lupparent->pic_action }}</td>                      
                    <td>@date($lupparent->duedate_action,'d-M-y')</td> 
                      @if ($statusaction[$index]=='OVERDUE')
                        <td class="bg-danger text-white">{{ $statusaction[$index] }}</td>
                      @elseif ($statusaction[$index]=='CLOSED')
                        <td class="bg-success text-white">{{ $statusaction[$index] }}</td>
                      @elseif ($statusaction[$index]=='ON EXTENSION')
                        <td class="bg-primary text-white">{{ $statusaction[$index] }}</td>
                      @else
                        <td >{{ $statusaction[$index] }}</td>
                      @endif         
                    <td class="setwidth"><textarea  readonly>{{ $lupparent->documentname }}</textarea></td>                    
                    <td class="setwidth"><textarea  readonly>{!! $lupparent->lup_proposed !!}</textarea></td>                                   
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
                    
                            
                    
                    
                    


