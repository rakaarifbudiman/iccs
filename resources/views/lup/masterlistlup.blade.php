@extends('layouts.admin.master')

@section('title', 'List LUP ICCS')

@section('content')

<div class="pagetitle">
  @component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>List LUP ICCS</h3>
		@endslot       
  @endcomponent
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
                    <th scope="col">Code</th>               
                    <th scope="col">No. LUP</th>                   
                    <th style="width: 1px !important;">Title</th>
                    <th scope="col">Current Condition</th>
                    <th scope="col">Proposed Change</th>
                    <th scope="col">Reason for Change</th>
                    <th scope="col">Inisiator</th>                
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
                      <td>{{ $lupparent->lup_code }}</td>
                      <td>{{ $lupparent->nolup }}</td>    
                      <td class="setwidth">{{ $lupparent->documentname }}</td>
                      <td class="setwidth">{!! $lupparent->lup_current !!}</td>
                      <td class="setwidth">{!! $lupparent->lup_proposed !!}</td>
                      <td class="setwidth">{!! $lupparent->lup_reason !!}</td>     
                      <td>{{ $lupparent->inisiator }}</td>                 
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
                    
                            
                    
                    
                    


