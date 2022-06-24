
@if(auth()->user()->level==3)   

  @if($flp->flpstatus=="CLOSED")                         
  @elseif($flp->flpstatus=="OPEN")
      @if($statusaction[$i]=="ON EXTENSION")
        <a href="/flpaction/{{ $id }}/approvedextension" class="btn btn-sm btn-success" title="Approved Due Date Extension"><i class="bi-check-lg"></i></a>
        <a href="/flpaction/{{ $id }}/rejectextension" class="btn btn-sm btn-danger" title="Reject Due Date Extension"><i class="bi-dash-circle"></i></a>
      @else                       
       
      @endif                                   
                      
  @else
  @endif    
@endif                           