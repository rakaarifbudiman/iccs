<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      ...
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            @can('update',$lupaction)
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaleditaction{{ $lupaction->id }}" title="Edit Action Plan"><i class="ri-edit-2-fill"></i>Edit Action Plan</a></li>                                                                       
            <li><a class="dropdown-item" href="/lup/action/{{Crypt::encryptString($lupaction->id)}}/delete" onclick="return confirm('Are you sure want to delete this action ?');" title="Delete Action Plan"><i class=" ri-delete-bin-5-fill"></i></a></li>                             
        @endcan
        @can('sign',$lupaction)
            <li><a class="dropdown-item" href="/lup/action/{{Crypt::encryptString($lupaction->id)}}/sign" onclick="return confirm('Are you sure want to sign this lup ?');" title="Sign Action Plan"><i class="bi-check-lg"></i></a></li>                                                
        @elsecan('cancelsign',$lupaction)
            <li><a class="dropdown-item" href="/lup/action/{{Crypt::encryptString($lupaction->id)}}/cancelsign" onclick="return confirm('Are you sure want to cancel sign this lup ?');" title="Cancel Sign Action Plan"><i class="bi-person-x"></i></a></li> 
        @endcan   
        @can('upload',$lupaction)
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $lupaction->id}}" title="Upload Closing Evidence"><i class="bi-upload"></i></a></li>                                                
        @endcan
        <li><a class="dropdown-item" href="/lup/action/{{ Crypt::encryptString($lupaction->id) }}/downloadevidence" title="Download Closing Evidence" 
            {{ $lupaction->evidence_filename ? '' : 'hidden'}}><i class=" bi-download">Download Closing Evidence</i>
        </a></li>
        @can('approvedevidence',$lupaction)
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedwithevidence{{ $lupaction->id }}"  title="Approved Closing Evidence" {{!$lupaction->evidence_filename ? 'hidden' : ''}}><i class="bi-file-earmark-check"></i></a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedevidence{{ $lupaction->id }}"  title="Approved Closing Evidence" {{$lupaction->evidence_filename ? 'hidden' : ''}}><i class="bi-file-earmark-check"></i></a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrejectevidence{{ $lupaction->id }}"  title="Reject Closing Evidence" {{!$lupaction->evidence_filename ? 'hidden' : ''}}><i class="bi-file-earmark-x"></i></a></li>
        @endcan        
        @can('extended',$lupaction)              
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalextension{{ $lupaction->id }}"  title="Submit Due Date Extension"><i class="bi-calendar-plus"></i></a></li>
        @endcan
        @can('reviewextended',$lupaction)       
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalreviewextension{{ $lupaction->id }}" title="Review Due Date Extension"><i class="bi-calendar-week"></i></a></li>
        @endcan
        @can('approvedextended',$lupaction)   
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedextension{{ $lupaction->id }}"  title="Approved Due Date Extension"><i class="bi-calendar-check"></i></a></li>
        @endcan
        @can('rejectextended',$lupaction)
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrejectextension{{ $lupaction->id }}"  title="Reject Due Date Extension"><i class="bi-calendar-minus"></i></a></li>              
        @endcan
        @can('requestcancelaction',$lupaction)
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrequestcancelaction{{ $lupaction->id }}"  title="Request Cancel Action"><i class="bi-bookmark-x"></i></a></li>                                       
        @endcan
        @can('approvedcancelaction',$lupaction)
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedcancelaction{{ $lupaction->id }}"  title="Approved Cancel Action"><i class="bi-bookmark-check"></i></a></li>                            
        @endcan  
    </ul>
  </div>
                    