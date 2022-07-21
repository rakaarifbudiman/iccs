<div class="tab-pane fade attachments pt-0" id="attachments"> <!-- Attachments Form -->
    @if($flp->flpstatus=="OPEN" OR $flp->flpstatus=="CLOSED") 
    <a href="#" class="btn btn-sm btn-success add" data-bs-toggle="modal" data-bs-target="#modaladdevidence{{ $flp->id }}" title="Add Additional Closing Evidence"><i class=" ri-add-fill">Additional Closing Evidence</i></a>     
    @else 
      <a href="#" class="btn btn-sm btn-success add" data-bs-toggle="modal" data-bs-target="#modaladdattachment{{ $flp->id }}" title="Add Attachment"><i class=" ri-add-fill">Add Attachment</i></a>  
    @endif  
  <div class="row">
        <div class="table-responsive text-nowrap">
            <table class="table datatable w-auto small" id="FLPAttachmentsTable">
            <thead>    
                <tr>
                    <th scope="col"> No. </th>
                    <th scope="col">Operation</th>
                    <th scope="col">Document Title</th>  
                    <th scope="col">Uploader</th>             
                    <th scope="col">Date Upload</th>                                 
                </tr>
            </thead>
            
              <tbody>
    
                @foreach ($flp->lupfile->where('is_evidence',false) as $index =>$flpfile)            
                
                <tr>
                    <th scope="row">{{ $index +1 }}</th>
                    <td>
                      @php
                        $id= Crypt::encryptString($flpfile->id);
                        $i=$index;
                      @endphp
                      
                        
                        @if($flp->flpstatus=="OPEN" OR $flp->flpstatus=="CLOSED")
                                    
                        <a href="/downloadattflp/{{ $id }}" class="btn btn-sm btn-success" title="Download Attachment"><i class=" bi-download"></i></a>
                            
                        @else                           
                            
                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditattachments{{ $flpfile->id }}" title="Change Attachment"><i class="ri-edit-2-fill"></i></a>
                                <a href="/downloadattflp/{{ $id }}" class="btn btn-sm btn-success" title="Download Attachment"><i class=" bi-download"></i></a>
                                <a href="/flpfiles/delete/{{ $id }}" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete Attachment"><i class=" ri-delete-bin-5-fill"></i></a>                           
                            
                        @endif                            
                        
                    </td>
                                              
                        
                        
                         
                    
                    <td>{{ $flpfile->document_name }}</td>                    
                    <td>{{ $flpfile->uploader }}</td>
                    <td>{{ date('d-M-Y',strtotime($flpfile->date_upload)) }}</td>                 
                                                         
                                        
                </tr>
                @include('flp.modal.modaleditattachments')
                @endforeach
                </tbody>
              </table>        
        </div>
      </div>
</div>           <!-- End Attachments Form --> 
@include('flp.modal.modaladdactionflp')