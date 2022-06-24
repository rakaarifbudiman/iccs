<div class="container ml-12">
    @if($flpaction->actionstatus=="OPEN") 
      <a href="#" class="btn btn-sm btn-success add w-auto small" data-bs-toggle="modal" data-bs-target="#modaladdattachment{{ $flp->id }}" title="Upload Additional Closing Evidence Here"><i class=" ri-add-fill">Upload Additional Closing Evidence Here</i></a>  
    @else 
      
    @endif
  
    <div class="table-responsive text-nowrap">
        <table class="table w-auto small">
        <thead>    
            <tr>                
                <th scope="col">Operation</th>
                <th scope="col">Document Title</th>  
                <th scope="col">Uploader</th>             
                <th scope="col">Date Upload</th>   
                <th scope="col">Action ID</th>                               
            </tr>
        </thead>
        
          <tbody>
            
            @foreach ($flpfiles->where('actionid',$flpaction->action_id) as $index =>$flpfile)            
              
            <tr>                
                <td>
                    @php
                      $i=$index;
                      $id= Crypt::encryptString($flpfile->id);
                      
                    @endphp
                  @if($flpaction->actionstatus=="OPEN")
                              
                          <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditattachments{{ $flpfile->id }}" title="Change Attachment"><i class="ri-edit-2-fill"></i></a>
                          <a href="/downloadattflp/{{ $id }}" class="btn btn-sm btn-success" title="Download Attachment"><i class=" bi-download"></i></a>
                          <a href="/flpfiles/delete/{{ $id }}" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete Attachment"><i class=" ri-delete-bin-5-fill"></i></a>                           
                  @elseif($flpaction->actionstatus=="CLOSED"  AND $flpfile->document_name)    
                          <a href="/downloadattflp/{{ $id }}" class="btn btn-sm btn-success" title="Download Attachment"><i class=" bi-download"></i></a>
                  @else                          
                  @endif                            
                  
                </td>
                <td>{{ $flpfile->document_name }}</td>                    
                <td>{{ $flpfile->uploader }}</td>
                <td>{{ date('d-M-Y',strtotime($flpfile->date_upload)) }}</td>   
                <td>{{ $flpfile->actionid }}</td>                
                                                    
                                    
            </tr>
            @include('flp.modal.modaleditevidences')
            @endforeach
            </tbody>
          </table>        
    </div>
</div>
                    
                    
                        
                            
                                          
                    
                    
                    
                