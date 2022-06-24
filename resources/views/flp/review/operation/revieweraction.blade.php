
@if(auth()->user()->level>1)
    @if($flp->flpstatus=="CLOSED")                                
    @elseif($flp->flpstatus=="OPEN")      
        @if($statusaction[$i]=="ON EXTENSION")
            <a href="/flpaction/{{ $id }}/submitextension" class="btn btn-sm btn-success" title="Submit Due Date Extension"><i class="bi-arrow-right-square"></i></a>
            <a href="/flpaction/{{ $id }}/rejectextension" class="btn btn-sm btn-danger" title="Reject Due Date Extension"><i class="bi-dash-circle"></i></a>
        @elseif($statusaction[$i]=="OPEN" || $statusaction[$i]=="OVERDUE")
          @if (!$flpaction->evidence_filename)            
            <a href="/flpaction/{{ $id }}/approvedcancelaction" class="btn btn-sm btn-warning" title="Approved Cancel Action"><i class="bi-file-x"></i></a>
          @else
            <a href="/flpaction/{{ $id }}/approvedevidence" onclick="return confirm('Approved this closing evidence ?');" class="btn btn-sm btn-success" title="Approved Closing Evidence"><i class="bi-check-lg"></i></a>
            <a href="/flpaction/{{ $id }}/rejectevidence" class="btn btn-sm btn-danger" title="Reject Closing Evidence"><i class="bi-dash-circle"></i></a>
          @endif
        @else                             
          
        @endif                                            
                        
    @else                                                                
    @endif           

@endif                           