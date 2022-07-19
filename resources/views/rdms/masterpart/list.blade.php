@extends('layouts.admin.master')

@section('title', 'List Part')

@section('content')

<div class="pagetitle">
  <h1>List Part</h1>
  <nav style="--bs-breadcrumb-divider: '|';">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="/masterpart"><i class="ri-home-3-line"></i></a></li>
      <li class="breadcrumb-item active">List Part SAP </li>
      <li class="breadcrumb-item active">
        <a href="/newpart" title="Create New Part SAP"><i class="ri-add-box-line"></i></a>
      </li>       
    </ol>
    <ol class="breadcrumb mt-0">
      <li class="breadcrumb-item"><a href="/"><i class="ri-home-3-line"></i></a></li>
      <li class="breadcrumb-item active">List Part RDS</li>
      <li class="breadcrumb-item active">
        <a href="/newpart" title="Create New Part RDMS"><i class="ri-add-box-line"></i></a>
      </li>  
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
                    <th scope="col">Created Date</th>
                    <th scope="col">Material Type</th>
                    <th scope="col">Material Group</th>
                    <th scope="col">Old Part</th>
                    <th scope="col">Old Description</th>               
                    <th scope="col">Part SAP</th>                    
                    <th scope="col">Part Description</th>                    
                    <th scope="col">UoM SAP</th>
                    <th scope="col">No Edisi</th>
                    <th scope="col">Reason Change</th>
                    <th scope="col">Requester</th>
                    <th scope="col">SAP Status</th>
                    <th scope="col">RDMS Status</th>
                    <th scope="col">Remarks</th>                
                    <th scope="col">SAP Date Input</th>
                    
                    
                </tr>
              </thead>
              <tbody>
                
                @forelse ($masterparts as $index =>$masterpart)            
                
                <tr>
                    <th scope="row">{{ $index +1 }}</th>
                    <td>
                      @php                    
                        $id= Crypt::encryptString($masterpart->id);
                        $tab= 'details';
                        $i=$index;
                      @endphp                      
                        <a href="#" class="btn btn-sm btn-primary edit" title="Edit Master Part"
                          onclick="window.open('/masterpart/{{$id}}/edit/','_blank').focus"><i class="ri-edit-2-fill"></i></a>
                        <a href="#" class="btn btn-sm bg-secondary text-light print" title="print FLP"
                          onclick="window.open('/flp/{{$id}}/printflp','_blank').focus"><i class="ri-printer-fill"></i></a>
                    </td>
                    <td>@date($masterpart->created_at,'d-M-y')</td> 
                    <td>{{ $masterpart->sap_mat_type }}</td>
                    <td>{{ $masterpart->sap_mat_group }}</td>
                    <td>{{ $masterpart->old_part }}</td>  
                    <td>{{ $masterpart->old_desc }}</td>
                    <td>{{ $masterpart->sap_part }}</td>                     
                    <td>{{ $masterpart->sap_desc }}</td>  
                    <td>{{ $masterpart->sap_uom }}</td> 
                    <td>{{ $masterpart->sap_edisi }}</td> 
                    <td>{{ $masterpart->note_change }}</td> 
                    <td>{{ $masterpart->requester_part }}</td> 
                    <td>{{ $masterpart->sap_status_part }}</td> 
                    <td>{{ $masterpart->rdms_status_part }}</td> 
                    <td>{{ $masterpart->rdms_remarks }}</td> 
                    <td>@date($masterpart->sap_date_input,'d-M-y')</td>                  
                                
                </tr>         
                  
                @empty
                @endforelse                
                </tbody>
              </table>        
        </div>
      </div>
    </div>
  </div>

</section>
@stop
                            
                    
                    
                    

