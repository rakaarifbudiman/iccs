<div class="tab-pane fade approval pt-0" id="approval"> <!-- Approval Form --> 
    @include('lup.modal.edit.signapproval')
  <div class="row"> {{-- basic approval --}}
        <div class="table-responsive"> 
            <table class="table w-auto small" id="lupTable">
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
                            @can('signreviewerqse',$lupparent)
                                <a href="#" class="btn btn-sm btn-success edit" data-bs-toggle="modal" data-bs-target="#modalsign_reviewer{{ $lupparent->id }}" title="Sign reviewer"><i class="bi-check-lg"></i></a>                                                                                       
                            @endcan     
                                
                        </th>                                        
                        <th scope="row">Review by QSE</th>                                               
                        <td>{{ $lupparent->reviewer }}</td>                    
                        <td>{{ $lupparent->reviewer ? $lupparent->reviewers->department :''}}</td>
                        <td class="{{$lupparent->datesubmit_reviewer2 ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->datesubmit_reviewer2,'d-M-y')</td> 
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->note_reviewer }}</textarea></td>                        
                    </tr>
                    <tr>
                        <th scope="row">
                            @can('signreviewerqcjm',$lupparent)
                                <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaleditapprover{{ $lupparent->id }}" title="Edit Approver"><i class="ri-edit-2-fill"></i></a>                   
                                <a href="#" class="btn btn-sm btn-success edit" data-bs-toggle="modal" data-bs-target="#modalsign_reviewerqcjm{{ $lupparent->id }}" title="Sign reviewer 2"><i class="bi-check-lg"></i></a>                                                                                       
                            @endcan                               
                        </th>
                        <th scope="row">Review by QCJM</th>                                               
                        <td>{{ $lupparent->reviewer2 }}</td>                    
                        <td>{{ $lupparent->reviewer2 ? $lupparent->reviewerqcjms->department :''}}</td>
                        <td class="{{$lupparent->datesubmit_approver ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->datesubmit_approver,'d-M-y')</td> 
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->note_reviewer2 }}</textarea></td> 
                        
                    </tr>
                    <tr>
                        <th scope="row">
                            @can('signapprover',$lupparent)
                                <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaleditapprover{{ $lupparent->id }}" title="Edit Approver"><i class="ri-edit-2-fill"></i></a>                   
                                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalapprovedlup{{ $lupparent->id }}" title="Approved lup"><i class="bi-check-lg"></i></a>                   
                            @endcan
                        </th>
                        <th scope="row">Approver</th>                                               
                        <td>{{ $lupparent->approver }}</td>                    
                        <td>{{ $lupparent->approver ? $lupparent->approvers->department :'' }}</td>
                        <td class="{{$lupparent->dateapproved ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->dateapproved,'d-M-y')</td>
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->note_approver }}</textarea></td>                         
                    </tr>         
                    <tr>
                        <th scope="row">
                            @can('confirmedlup',$lupparent)
                                <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaleditconfirmer{{ $lupparent->id }}" title="Edit Confirmer"><i class="ri-edit-2-fill"></i></a>                       
                                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalconfirmedlup{{ $lupparent->id }}" title="Confirmed LUP"><i class="bi-check-lg"></i></a>                   
                            @endcan 
                            
                        </th>
                        <th scope="row">Confirmer</th>                                               
                        <td>{{ $lupparent->confirmer }}</td>                    
                        <td>{{ $lupparent->confirmer ? $lupparent->confirmers->department : '' }}</td>
                        <td class="{{$lupparent->dateconfirmed ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->dateconfirmed,'d-M-y')</td>
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->note_confirmer }}</textarea></td>
                        
                    </tr>        
                    <tr>
                        <th scope="row">
                            @can('reviewcancel',$lupparent)
                                <a title="Review Cancel LUP" class="btn btn-sm btn-success" href="#" data-bs-toggle="modal" data-bs-target="#modalreviewcancellup{{$lupparent->id}}"><i class="bi-check-lg"></i>                                         
                            @endcan                          
                        </th>
                        <th scope="row">Cancel Reviewer</th>                                               
                        <td>{{ $lupparent->cancel_reviewer }}</td>                    
                        <td>{{ $lupparent->cancel_reviewer ? $lupparent->cancel_reviewers->department : '' }}</td>
                        <td>@date($lupparent->datecancel_reviewed,'d-M-y')</td>
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->cancel_notes }}</textarea></td>                        
                    </tr>        
                    <tr>
                        <th scope="row">
                            @can('approvedcancel',$lupparent)
                                <a title="Approved Cancel LUP" class="btn btn-sm btn-success" href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedcancellup{{$lupparent->id}}"><i class="bi-check-lg"></i>             
                            @endcan                        
                        </th>
                        <th scope="row">Cancel Approver</th>                                               
                        <td>{{ $lupparent->cancel_approver }}</td>                    
                        <td>{{ $lupparent->cancel_approver ? $lupparent->cancel_approvers->department : '' }}</td>
                        <td>@date($lupparent->datecancel_approved,'d-M-y')</td>
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->approvercancel_notes }}</textarea></td>                        
                    </tr>        
                    <tr>
                        <th scope="row">
                            @can('requestclosinglup',$lupparent)
                                <a title="Request Closing LUP" class="btn btn-sm btn-success" href="#" data-bs-toggle="modal" data-bs-target="#modalrequestclosinglup{{$lupparent->id}}"><i class="bi-check-lg"></i>         
                            @endcan                             
                        </th>
                        <th scope="row">Closing Reviewer</th>                                               
                        <td>{{ $lupparent->reviewer_closing }}</td>                    
                        <td>{{ $lupparent->reviewer_closing ? $lupparent->closing_reviewers->department : '' }}</td>
                        <td class="{{$lupparent->dateclosing_reviewer ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->dateclosing_reviewer,'d-M-y')</td>
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->closing_notes }}</textarea></td>                        
                    </tr>        
                    <tr>
                        <th scope="row">
                            @can('closinglup',$lupparent)
                                <a title="Approved Closing LUP" class="btn btn-sm btn-success" href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedclosinglup{{$lupparent->id}}"><i class="bi-check-lg"></i>                                         
                            @endcan          
                            @can('displayclosinglup',$lupparent)                   
                                <a title="Display Closing LUP" class="btn btn-sm btn-secondary text-white" href="#" data-bs-toggle="modal" data-bs-target="#modaldisplayclosinglup{{$lupparent->id}}"><i class="bi-eye"></i>         
                            @endcan    
                        </th>
                        <th scope="row">Closing Approver</th>                                               
                        <td>{{ $lupparent->approver_closing }}</td>                    
                        <td>{{ $lupparent->approver_closing ? $lupparent->closing_approvers->department : '' }}</td>
                        <td class="{{$lupparent->dateclosing_approver ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->dateclosing_approver,'d-M-y')</td>
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->approverclosing_notes }}</textarea></td>                        
                    </tr>                          
                        
         
                    {{-- @include('lup.modal.modalapproval') --}}
                    </tbody>
                  </table>        
        </div>
      </div> {{-- End basic approval --}}
      
</div>           <!-- End Approval Form --> 
                                                      
                            
                        
                        
                        
