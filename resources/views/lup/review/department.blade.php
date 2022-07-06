<div class="tab-pane fade departments pt-0" id="departments"> <!-- Approval Form -->
  <div class="row"> {{-- department approval --}}
        <div class="table-responsive">
            <table class="table w-auto small" id="lupTable">
                <thead>    
                    <tr>
                        <th scope="col-md-2">No.</th>
                        <th scope="col-md-2">Operation</th>
                        <th scope="col-md-2">Approval Type</th>
                        <th scope="col-md-2">Username</th>   
                        <th scope="col-md-2">Department</th>                                
                        <th scope="col-md-1">Sign Date</th>   
                        <th scope="col-md-2">Notes</th>                                   
                    </tr>
                </thead>
                
                <tbody>
                    <th colspan="6" class="text-small">
                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modaladddepartment{{ $lupparent->id }}" title="Add" 
                            {{$lupparent->lupstatus=="ON REVIEW" ? : 'hidden'}}>
                            Add Department<i class="ri-add-fill"></i>
                        </a>
                    </th>   
                    <tr>
                        <th>1</th>
                        <th scope="row"> 
                            @can('signinisiator',$lupparent)
                            <a href="/lup/{{Crypt::encryptString($lupparent->id)}}/signinisiator" onclick="return confirm('Are you sure want to sign this lup ?');" class="btn btn-success btn-sm" title="Sign Inisiator"><i class="bi-check-lg"></i></a>                                                
                            @elsecan('cancelsigninisiator',$lupparent)
                            <a href="/lup/{{Crypt::encryptString($lupparent->id)}}/cancelsigninisiator" onclick="return confirm('Are you sure want to cancel sign this lup ?');" class="btn btn-info btn-sm" title="Cancel Sign Inisiator"><i class="bi-person-x"></i></a> 
                            @endcan                                                     
                        </th>
                        <th scope="row">Inisiator</th>                                               
                        <td>{{ $lupparent->inisiator }}</td>                    
                        <td>{{ $lupparent->inisiator ? $lupparent->inisiators->department : ''}}</td>
                        <td class="{{$lupparent->datesign_inisiator ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->datesign_inisiator,'d-M-y')</td>
                  </tr>
                  <tr>
                    <th>2</th>
                      <th scope="row">
                        @can('updateleader',$lupparent)
                            <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaledit_leader{{ $lupparent->id }}" title="Edit Leader"><i class="ri-edit-2-fill"></i></a>              
                        @endcan  
                        @can('signleader',$lupparent)                            
                            <a href="#" class="btn btn-sm btn-success edit" data-bs-toggle="modal" data-bs-target="#modalsign_leader{{ $lupparent->id }}" title="Sign Leader & Comment"><i class="bi-check-lg"></i></a>                                                                       
                        @elsecan('cancelsignleader',$lupparent)
                            <a href="/lup/{{Crypt::encryptString($lupparent->id)}}/cancelsignleader" onclick="return confirm('Are you sure want to cancel sign this lup ?');" class="btn btn-info btn-sm" title="Cancel Sign leader"><i class="bi-person-x"></i></a>
                        @endcan
                        
                      </th>
                      <th scope="row">Leader</th>                                               
                      <td>{{ $lupparent->leader }}</td>                    
                      <td>{{ $lupparent->leader ? $lupparent->leaders->department :'' }}</td>
                      <td class="{{$lupparent->datesign_leader ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->datesign_leader,'d-M-y')</td> 
                      <td class="setwidth"><textarea  readonly>{{ $lupparent->note_leader }}</textarea></td>  
                      
                  </tr>
                  <tr>
                    <th>3</th>
                      <th scope="row"> 
                        @can('updateregulatoryreviewer',$lupparent)                         
                            <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaledit_regulatory_reviewer{{ $lupparent->id }}" title="Edit Regulatory Reviewer"><i class="ri-edit-2-fill"></i></a>              
                        @endcan
                        @can('signregulatoryreviewer',$lupparent)     
                            <a href="#" class="btn btn-sm btn-success edit" data-bs-toggle="modal" data-bs-target="#modalsign_regulatory_reviewer{{ $lupparent->id }}" title="Sign Regulatory Reviewer & Comment"><i class="bi-check-lg"></i></a>                                                
                        @elsecan('cancelsignregulatoryreviewer',$lupparent)
                            <a href="/lup/{{Crypt::encryptString($lupparent->id)}}/cancelsignregulatoryreviewer" onclick="return confirm('Are you sure want to cancel sign this lup ?');" class="btn btn-info btn-sm" title="Cancel Sign Regulatory Reviewer"><i class="bi-person-x"></i></a>                                                             
                        @endcan
                      </th>
                      <th scope="row">Regulatory - Review</th>                                               
                      <td>{{ $lupparent->regulatory_reviewer }}</td>                    
                      <td>{{ $lupparent->regulatory_reviewer ? $lupparent->regulatory_reviewers->department :''}}</td>
                      <td class="{{($lupparent->datesubmit_regulatory_approver && $lupparent->regulatory_reviewer) ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->datesubmit_regulatory_approver,'d-M-y')</td> 
                      <td class="setwidth"><textarea  readonly>{{ $lupparent->note_regulatory_reviewer }}</textarea></td>  
                     
                  </tr>
                  <tr>
                    <th>4</th>
                      <th scope="row">
                        @can('updateregulatoryapprover',$lupparent)  
                            <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaledit_regulatory_approver{{ $lupparent->id }}" title="Edit Regulatory Approver"><i class="ri-edit-2-fill"></i></a>              
                        @endcan
                        @can('signregulatoryapprover',$lupparent)  
                            <a href="#" class="btn btn-sm btn-success edit" data-bs-toggle="modal" data-bs-target="#modalsign_regulatory_approver{{ $lupparent->id }}" title="Sign Regulatory Approver & Comment"><i class="bi-check-lg"></i></a>                                                
                        @elsecan('cancelsignregulatoryapprover',$lupparent) 
                            <a href="/lup/{{Crypt::encryptString($lupparent->id)}}/cancelsignregulatoryapprover" onclick="return confirm('Are you sure want to cancel sign this lup ?');" class="btn btn-info btn-sm" title="Cancel Sign Regulatory approver"><i class="bi-person-x"></i></a>                                                             
                        @endcan
                      </th>
                      <th scope="row">Regulatory - Approval</th>                                               
                      <td>{{ $lupparent->regulatory_approver ? $lupparent->regulatory_approvers->name : '' }}</td>                    
                      <td>{{ $lupparent->regulatory_approver ? $lupparent->regulatory_approvers->department :''}}</td>
                      <td class="{{$lupparent->datesign_regulatory_approver ? 'bg-success text-white' :'bg-danger'}}">@date($lupparent->datesign_regulatory_approver,'d-M-y')</td> 
                      <td class="setwidth"><textarea  readonly>{{ $lupparent->note_regulatory_approver }}</textarea></td>  
                      
                  </tr>                      
                    <tr>
                        <th>5</th>
                        <th scope="row">
                            <a href="#" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#modaledit_external_party{{ $lupparent->id }}" title="Edit External Party"
                                {{$lupparent->lupstatus=="ON REVIEW" ? : 'hidden'}}><i class="ri-edit-2-fill"></i>
                            </a> 

                        </th>
                        <th scope="row">External Party</th>                                               
                        <td>{{ $lupparent->external_party_name }}</td>                    
                        <td>NA</td>    
                        <td>NA</td>                      
                        <td class="setwidth"><textarea  readonly>{{ $lupparent->note_external_party }}</textarea></td>  
                        
                    </tr>     
                    @include('lup.modal.edit.signrelateddepartment')                     
                    @forelse ($lupparent->relateddepartment as $index=>$relateddepartment)
                    <tr>
                        <th scope="row">{{ $index +6 }}</th> 
                        <td>          
                            @can('signrelateddepartment',$relateddepartment)
                                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modaleditdepartment{{ $relateddepartment->id }}" title="Comment and Sign"><i class="bi-check-lg"></i></a>                                                          
                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalnotifdepartment{{ $relateddepartment->id }}" title="Send Revise Notif to Inisiator"><i class="ri-mail-send-line"></i></a>                                                          
                            @elsecan('cancelsignrelateddepartment',$relateddepartment)
                                <a href="/lup/department-impact/{{Crypt::encryptString($relateddepartment->id)}}/cancelsign" onclick="return confirm('Are you sure want to cancel sign this lup ?');" class="btn btn-info btn-sm" title="Cancel Sign Department"><i class="bi-person-x"></i></a>                                                             
                            @endcan   
                            @can('deleterelateddepartment',$relateddepartment) 
                                <a href="/lup/department-impact/{{Crypt::encryptString($relateddepartment->id)}}/delete" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete"><i class=" ri-delete-bin-5-fill"></i></a>                             
                            @endcan     
                              
                          </td>
                        <th>{{ $relateddepartment->department}}</th>  
                        <td>{{ $relateddepartment->username }}</td>    
                        <td>{{ $relateddepartment->username ? $relateddepartment->user->department : '' }}</td>                                       
                        <td class="{{$relateddepartment->signdate ? 'bg-success text-white' :'bg-danger'}}">@date($relateddepartment->signdate,'d-M-y')</td>
                        <td class="setwidth"><textarea  readonly>{{ $relateddepartment->note  }}</textarea></td> 
                     @include('lup.modal.edit.editrelateddepartment')                                                                   
                    </tr>   
                    @empty
                        
                    @endforelse
                </tbody>
            </table>        
        </div>
      </div> {{-- End department approval --}}
      
</div>           <!-- End Approval Form --> 
                                                      
                            
                        
                        
                        
