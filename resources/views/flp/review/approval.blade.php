<div class="tab-pane fade approval pt-0" id="approval"> <!-- Approval Form -->
    @if($flp->flpstatus=="OPEN" OR $flp->flpstatus=="CLOSED") 
    @else 
      
    @endif  
  <div class="row">
        <div class="table-responsive">
                        @php
                            $id= Crypt::encryptString($flp->id);                        
                        @endphp
            <table class="table w-auto small" id="FLPTable">
                <thead>    
                    <tr>
                        <th scope="col-md-2">Operation</th>
                        <th scope="col-md-2">Approval Type</th>
                        <th scope="col-md-2">Username</th>  
                        <th scope="col-md-2">Department</th>             
                        <th scope="col-md-1">Sign Date</th>   
                        <th scope="col-md-2">Notes</th>                                   
                    </tr>
                </thead>
                
                  <tbody>      
                    <tr>
                          <th scope="row">
                            @if($flp->flpstatus=="OPEN" OR $flp->flpstatus=="CLOSED")                                
                            @else
                                @if (!$flp->datesign_inisiator)                                    
                                    <a href="/flp/{{$id}}/signinisiator" onclick="return confirm('Are you sure want to sign this FLP ?');" class="btn btn-success btn-sm" title="Sign Inisiator"><i class="bi-check-lg"></i></a>   
                                @else
                                    <a href="/flp/{{$id}}/cancelsigninisiator" onclick="return confirm('Are you sure want to cancel sign this FLP ?');" class="btn btn-info btn-sm" title="Cancel Sign Inisiator"><i class="bi-person-x"></i></a>                                                             
                                @endif
                            @endif
                          </th>
                          <th scope="row">Inisiator</th>                                               
                          <td>{{ $flp->inisiator }}</td>                    
                          <td>{{ $flp->deptinisiator }}</td>
                          <td>@date($flp->datesign_inisiator,'d-M-y')</td> 
                    </tr>
                    <tr>
                        <th scope="row">
                            @if($flp->flpstatus=="OPEN" OR $flp->flpstatus=="CLOSED")                                
                            @else
                                @if (!$flp->datesign_leader)
                                    <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaleditleader{{ $flp->id }}" title="Edit leader"><i class="ri-edit-2-fill"></i></a>                   
                                    <a href="/flp/{{$id}}/signleader" onclick="return confirm('Are you sure want to sign this FLP ?');" class="btn btn-success btn-sm" title="Sign leader"><i class="bi-check-lg"></i></a>   
                                @else
                                    <a href="/flp/{{$id}}/cancelsignleader" onclick="return confirm('Are you sure want to cancel sign this FLP ?');" class="btn btn-info btn-sm" title="Cancel Sign leader"><i class="bi-person-x"></i></a>                                                             
                                @endif
                            @endif
                        </th>
                        <th scope="row">Leader</th>                                               
                        <td>{{ $flp->leader }}</td>                    
                        <td>{{ $flp->deptleader }}</td>
                        <td>@date($flp->datesign_leader,'d-M-y')</td> 
                    </tr>
                    <tr>
                        <th scope="row">
                            @if($flp->flpstatus=="CLOSED")
                            @elseif($flp->flpstatus=="OPEN")
                                <a href="/flp/{{$id}}/cancelflp" onclick="return confirm('Are you sure want to cancel this FLP ?');" class="btn btn-danger btn-sm" title="Cancel FLP"><i class="bi-journal-x"></i></a>                                                               
                                    @elseif($flp->flpstatus=="ON REVIEW" OR $flp->flpstatus=="ON APPROVAL")
                                @if (!$flp->datesubmit_approver)                                    
                                    <a href="/flp/{{$id}}/signreviewer" onclick="return confirm('Are you sure want to submit this FLP ?');" class="btn btn-success btn-sm" title="Sign reviewer"><i class="bi-check-lg"></i></a>                                     
                                @else                                                                                             
                                @endif
                                <a href="/flp/{{$id}}/rollbackinisiator" onclick="return confirm('Are you sure want to cancel sign this FLP ?');" class="btn btn-warning btn-sm" title="Roll Back to Inisiator"><i class="bi-arrow-counterclockwise"></i></a>                                                                                                                                 
                                <a href="/flp/{{$id}}/cancelflp" onclick="return confirm('Are you sure want to cancel this FLP ?');" class="btn btn-danger btn-sm" title="Cancel FLP"><i class="bi-journal-x"></i></a>                                                               
                            @elseif($flp->flpstatus=="CANCEL")
                                <a href="/flp/{{$id}}/reactivation" onclick="return confirm('Are you sure want to reactivation this FLP ?');" class="btn btn-success btn-sm" title="Reactivation"><i class="bi-check-lg"></i></a>                                     
                            @else
                                <form method="POST" action="/flp/{{$id}}/submittoreviewer">
                                @csrf
                                @method('put')
                                <div class="button-box col-lg">
                                <button type="submit" onclick="return confirm('Are you sure want to submit this FLP ?');" class="btn btn-primary btn-sm float-left"><i class="bi-arrow-right-square" title="Submit to Reviewer"></i></button>                                
                                </form><span>
                                <a href="/flp/{{$id}}/cancelflp" onclick="return confirm('Are you sure want to cancel this FLP ?');" class="btn btn-danger btn-sm float-left" title="Cancel FLP"><i class="bi-journal-x"></i></a></span>                                                               
                                </div>
                            @endif
                            
                        </th>
                        <th scope="row">Reviewer</th>                                               
                        <td>{{ $flp->reviewer }}</td>                    
                        <td>{{ $flp->deptreviewer }}</td>
                        <td>@date($flp->datesubmit_approver,'d-M-y')</td> 
                        <td class="w-25">{{ $flp->notes1 }}</td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaleditapprover{{ $flp->id }}" title="Edit Approver"><i class="ri-edit-2-fill"></i></a>                   
                            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalapprovedflp{{ $flp->id }}" title="Approved FLP"><i class="bi-check-lg"></i></a>                   
                        </th>
                        <th scope="row">Approver</th>                                               
                        <td>{{ $flp->approver }}</td>                    
                        <td>{{ $flp->deptapprover }}</td>
                        <td>@date($flp->dateapproved,'d-M-y')</td>
                        <td class="w-25">{{ $flp->notes2 }}</td> 
                    </tr>
                          
                                                       
                        
         
                    @include('flp.modal.modalapproval')
                    </tbody>
                  </table>        
        </div>
      </div>
</div>           <!-- End Approval Form --> 
                                                      
                            
                        
                        
                        
