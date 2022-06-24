      @if($flp->flpstatus=="CLOSED")
          @if (!$flpaction->evidence_filename)                              
          @else                              
            <a href="/flpaction/{{ $id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence"><i class=" bi-download"></i></a>
          @endif                           
      @elseif($flp->flpstatus=="OPEN")          
            @if($statusaction[$i]=="CLOSED")
              <a href="/flpaction/{{ $id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence"><i class=" bi-download"></i></a>
            @elseif($statusaction[$i]=="OPEN" || $statusaction[$i]=="OVERDUE")
              @if (!$flpaction->evidence_filename)
                <a href="#" class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $flpaction->action_id }}" title="Upload Closing Evidence"><i class=" bi-upload"></i></a>              
                <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $flpaction->action_id }}" title="Due Date Extension"><i class="bi-calendar-plus"></i></a>                            
              @else
                <a href="#" class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $flpaction->action_id }}" title="Upload Closing Evidence"><i class=" bi-upload"></i></a>                            
                <a href="/flpaction/{{ $id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence"><i class=" bi-download"></i></a>
                
              @endif            
              
              <a href="#" class="btn btn-sm btn-danger edit" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $flpaction->action_id }}" title="Cancel Action"><i class="bi-file-x"></i></a>                            
            @else                              
              @if (!$flpaction->evidence_filename)
                <a href="#" class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $flpaction->action_id }}" title="Upload Closing Evidence"><i class=" bi-upload"></i></a>              
              @else
                <a href="#" class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $flpaction->action_id }}" title="Upload Closing Evidence"><i class=" bi-upload"></i></a>                            
                <a href="/flpaction/{{ $id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence"><i class=" bi-download"></i></a>
              @endif 
            @endif
                                                   
                                
      @elseif ($flp->flpstatus=="ON PROCESS")
          @if ($flpaction->signdate_action=="") 
          <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaleditaction{{ $flpaction->action_id }}" title="Edit Action Plan"><i class="ri-edit-2-fill"></i></a>                   
          <a href="/flpaction/{{$id}}/sign" onclick="return confirm('Are you sure want to sign this action ?');" class="btn btn-success btn-sm" title="Sign Action"><i class="bi-check-lg"></i></a>     
          <a href="/flpaction/delete/{{$id}}" id="btn-del-action-flp" onclick="return confirm('Are you sure want to delete this action ?');" class="btn btn-danger btn-sm" title="Delete Action"><i class=" ri-delete-bin-5-fill"></i></a>                         
          @else
            <a href="/flpaction/{{$id}}/cancelsign" onclick="return confirm('Are you sure want to cancel sign this action ?');" class="btn btn-info btn-sm" title="Cancel Sign Action"><i class="bi-person-x"></i></a>                                                         
          @endif
      @elseif ($flp->flpstatus=="ON REVIEW" || $flp->flpstatus=="ON APPROVAL")
      @else                            
          @if ($flpaction->signdate_action=="") 
            <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaleditaction{{ $flpaction->action_id }}" title="Edit Action Plan"><i class="ri-edit-2-fill"></i></a>                                                 
            <a href="/flpaction/delete/{{$id}}" id="btn-del-action-flp" onclick="return confirm('Are you sure want to delete this action ?');" data-category={{ $id }} class="btn btn-danger btn-sm" title="Delete Action"><i class=" ri-delete-bin-5-fill"></i></a>                                                       
          @endif                                                                               
      @endif            

          