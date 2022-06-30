<!-- Modal Edit Categorization-->
<div class="modal fade" id="modaleditcategorization{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adjust Categorization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="frm-categorization" id="frm-categorization" class="form-horizontal" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updatecategorization">
                @csrf
                @method('put')
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="categorization" class="col-sm col-form-label col-form-label-sm">Categorization</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="categorization" id="categorization" aria-label="Change Type" required autocomplete="off">
                                <option selected>{{$lupparent->categorization}}</option> 
                                <option value="Minor">Minor</option>     
                                <option value="Major">Major</option>   
                                <option value="Critical">Critical</option>  
                            </select>                                            
                        </div>                                 
                    </div>                      
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
                </div>
            </form>
      </div>
    </div>
</div>   

<!-- Modal Request Cancel LUP-->
<div class="modal fade" id="modalrequestcancellup{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Cancel LUP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="frm-categorization" id="frm-categorization" class="form-horizontal" action="/lup/{{Crypt::encryptString($lupparent->id)}}/requestcancellup">
                @csrf
                @method('put')
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="cancel_requester" class="col-sm col-form-label col-form-label-sm">Requester</label>
                        <div class="col-sm-8">
                            <input class="form-control form-control-sm" type="text" id="cancel_requester" name="cancel_requester" value="{{ AUTH::user()->username }}" disabled>                                   
                        </div>                                 
                    </div>      
                    <div class="row mb-3">
                        <label for="cancel_notes" class="col-sm col-form-label col-form-label-sm">Justification</label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" type="text" id="cancel_notes" name="cancel_notes" required minlength="10">{{old('cancel_notes')}}</textarea>                                   
                        </div>                                 
                    </div>                   
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary" name="saveaction">Submit</button>
                </div>
            </form>
      </div>
    </div>
</div>   

<!-- Modal Review Cancel LUP-->
<div class="modal fade" id="modalreviewcancellup{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review Cancel LUP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="frm-categorization" id="frm-categorization" class="form-horizontal" action="/lup/{{Crypt::encryptString($lupparent->id)}}/reviewcancellup">
                @csrf
                @method('put')
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="cancel_requester" class="col-sm col-form-label col-form-label-sm">Requester</label>
                        <div class="col-sm-8">
                            <input class="form-control form-control-sm" type="text" id="cancel_requester" name="cancel_requester" value="{{ $lupparent->cancel_requester }}" disabled>                                   
                        </div>                                 
                    </div>  
                    <div class="row mb-3">
                        <label for="cancel_reviewer" class="col-sm col-form-label col-form-label-sm">Verified By</label>
                        <div class="col-sm-8">
                            <input class="form-control form-control-sm" type="text" id="cancel_reviewer" name="cancel_reviewer" value="{{ AUTH::user()->username }}" disabled>                                   
                        </div>                                 
                    </div>     
                    <div class="row mb-3">
                        <label for="cancel_notes" class="col-sm col-form-label col-form-label-sm">Justification</label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" type="text" id="cancel_notes" name="cancel_notes" disabled>{{$lupparent->cancel_notes}}</textarea>                                   
                        </div>                                 
                    </div>             
                    <div class="row mb-3">
                        <label for="approver" class="col-sm col-form-label col-form-label-sm">Approver</label>
                        <div class="col-sm-8">
                            <input class="form-control form-control-sm" area="text" list="listapprover" id="approver" name="approver" placeholder="Select Approver" required autocomplete="off">                                               
                            <datalist id="listapprover">
                              @foreach ($listapprovers as $listapprover)
                                <option value="{{ $listapprover->username }}">{{ $listapprover->username }} - {{ $listapprover->name }}</option>
                              @endforeach
                          </datalist>       
                        </div>                                 
                      </div>               
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary" name="saveaction">Submit</button>
                </div>
            </form>
      </div>
    </div>
</div>   
<!-- Modal Approved Cancel LUP-->
<div class="modal fade" id="modalapprovedcancellup{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approved Cancel LUP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="frm-categorization" id="frm-categorization" class="form-horizontal" action="/lup/{{Crypt::encryptString($lupparent->id)}}/approvedcancellup">
                @csrf
                @method('put')
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="cancel_requester" class="col-sm col-form-label col-form-label-sm">Requester</label>
                        <div class="col-sm-8">
                            <input class="form-control form-control-sm" type="text" id="cancel_requester" name="cancel_requester" value="{{ $lupparent->cancel_requester }}" disabled>                                   
                        </div>                                 
                    </div>  
                    <div class="row mb-3">
                        <label for="cancel_reviewer" class="col-sm col-form-label col-form-label-sm">Verified By</label>
                        <div class="col-sm-8">
                            <input class="form-control form-control-sm" type="text" id="cancel_reviewer" name="cancel_reviewer" value="{{ $lupparent->cancel_reviewer}}" disabled>                                   
                        </div>                                 
                    </div>     
                    <div class="row mb-3">
                        <label for="cancel_notes" class="col-sm col-form-label col-form-label-sm">Justification</label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" type="text" id="cancel_notes" name="cancel_notes" disabled>{{$lupparent->cancel_notes}}</textarea>                                   
                        </div>                                 
                    </div>         
                    <div class="row mb-3">
                        <label for="approvercancel_notes" class="col-sm col-form-label col-form-label-sm">Comments</label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" type="text" id="approvercancel_notes" name="approvercancel_notes" required>{{$lupparent->approvercancel_notes}}</textarea>                                   
                        </div>                                 
                    </div>                 
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
                </div>
            </form>
      </div>
    </div>
</div>   

<!-- Modal Request Closing LUP-->
<div class="modal fade" id="modalrequestclosinglup{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Closing LUP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="frm-categorization" id="frm-categorization" class="form-horizontal" action="/lup/{{Crypt::encryptString($lupparent->id)}}/requestclosinglup">
                @csrf
                @method('put')
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="reviewer_closing" class="col-sm col-form-label col-form-label-sm">Review By</label>
                        <div class="col-sm-4">
                            <input class="form-control form-control-sm" type="text" id="reviewer_closing" name="reviewer_closing" value="{{$lupparent->reviewer_closing}}" disabled>                                   
                        </div>                                 
                    </div> 
                    <label class="col-sm col-form-label col-form-label-sm">Verification</label>                     
                    <div class="row mb-3">
                        <label for="verified_a" class="col-sm col-form-label col-form-label-sm">a. All Necessary Documents already created/revised</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_a" id="verified_a" aria-label="Change Type" required autocomplete="off">                                
                                <option value="{{$lupparent->verified_a}}" selected>{{$lupparent->verified_a}}</option>  
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>                                   
                            </select>    
                        </div>                                 
                    </div>     
                    <div class="row mb-3">
                        <label for="verified_b" class="col-sm col-form-label col-form-label-sm">b. All The Proposed Measured has been implemented</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_b" id="verified_b" aria-label="Change Type" required autocomplete="off">                                
                                <option value="{{$lupparent->verified_b}}" selected>{{$lupparent->verified_b}}</option>
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>                                   
                            </select>    
                        </div>                                 
                    </div>    
                    <div class="row mb-3">
                        <label for="verified_c" class="col-sm col-form-label col-form-label-sm">c. Notification Letter / Submission / Approval from Regulatory Authority</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_c" id="verified_c" aria-label="Change Type" required autocomplete="off">                                
                                <option value="{{$lupparent->verified_c}}" selected>{{$lupparent->verified_c}}</option>
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>    
                                <option value="Not Yet">NA</option>                                  
                            </select>    
                        </div>                                 
                    </div>         
                    <div class="row mb-3">
                        <label for="approver" class="col-sm col-form-label col-form-label-sm">Approver</label>
                        <div class="col-sm-4">
                            <input class="form-control form-control-sm" area="text" list="listapprover" id="approver" name="approver" placeholder="Select Approver" required autocomplete="off" value="{{$lupparent->approver_closing}}">                                               
                            <datalist id="listapprover">
                              @foreach ($listapprovers as $listapprover)                                
                                <option value="{{ $listapprover->username }}">{{ $listapprover->username }} - {{ $listapprover->name }}</option>
                              @endforeach
                          </datalist>       
                        </div>                                 
                      </div>                          
                    <div class="row mb-3">
                        <label for="closing_notes" class="col-sm col-form-label col-form-label-sm">Comments</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" type="text" id="closing_notes" name="closing_notes" required>{{$lupparent->closing_notes}}</textarea>                                   
                        </div>                                 
                    </div>                 
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
                </div>
            </form>
      </div>
    </div>
</div>   

<!-- Modal Approve Closing LUP-->
<div class="modal fade" id="modalapprovedclosinglup{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve Closing LUP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="frm-categorization" id="frm-categorization" class="form-horizontal" action="/lup/{{Crypt::encryptString($lupparent->id)}}/closinglup">
                @csrf
                @method('put')
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="reviewer_closing" class="col-sm col-form-label col-form-label-sm">Review By</label>
                        <div class="col-sm-4">
                            <input class="form-control form-control-sm" type="text" id="reviewer_closing" name="reviewer_closing" value="{{$lupparent->reviewer_closing}}" disabled>                                   
                        </div>                                 
                    </div> 
                    <label class="col-sm col-form-label col-form-label-sm">Verification</label>                     
                    <div class="row mb-3">
                        <label for="verified_a" class="col-sm col-form-label col-form-label-sm">a. All Necessary Documents already created/revised</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_a" id="verified_a" aria-label="Change Type" autocomplete="off" disabled>                                
                                <option value="{{$lupparent->verified_a}}" selected>{{$lupparent->verified_a}}</option>  
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>                                   
                            </select>    
                        </div>                                 
                    </div>     
                    <div class="row mb-3">
                        <label for="verified_b" class="col-sm col-form-label col-form-label-sm">b. All The Proposed Measured has been implemented</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_b" id="verified_b" aria-label="Change Type" autocomplete="off" disabled>                                
                                <option value="{{$lupparent->verified_b}}" selected>{{$lupparent->verified_b}}</option>
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>                                   
                            </select>    
                        </div>                                 
                    </div>    
                    <div class="row mb-3">
                        <label for="verified_c" class="col-sm col-form-label col-form-label-sm">c. Notification Letter / Submission / Approval from Regulatory Authority</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_c" id="verified_c" aria-label="Change Type" autocomplete="off" disabled>                                
                                <option value="{{$lupparent->verified_c}}" selected>{{$lupparent->verified_c}}</option>
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>    
                                <option value="Not Yet">NA</option>                                  
                            </select>    
                        </div>                                 
                    </div>         
                    <div class="row mb-3">
                        <label for="approver" class="col-sm col-form-label col-form-label-sm">Approver</label>
                        <div class="col-sm-4">
                            <input class="form-control form-control-sm" area="text" list="listapprover" id="approver" name="approver" placeholder="Select Approver" autocomplete="off" value="{{$lupparent->approver_closing}}" disabled>                                               
                            <datalist id="listapprover">
                              @foreach ($listapprovers as $listapprover)                                
                                <option value="{{ $listapprover->username }}">{{ $listapprover->username }} - {{ $listapprover->name }}</option>
                              @endforeach
                          </datalist>       
                        </div>                                 
                      </div>                          
                    <div class="row mb-3">
                        <label for="closing_notes" class="col-sm col-form-label col-form-label-sm">Comments by Reviewer</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" type="text" id="closing_notes" name="closing_notes" disabled>{{$lupparent->closing_notes}}</textarea>                                   
                        </div>                                 
                    </div>      
                    <div class="row mb-3">
                        <label for="approverclosing_notes" class="col-sm col-form-label col-form-label-sm">Comments</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" type="text" id="approverclosing_notes" name="approverclosing_notes" required>{{$lupparent->approverclosing_notes}}</textarea>                                   
                        </div>                                 
                    </div>             
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
                </div>
            </form>
      </div>
    </div>
</div>   

<!-- Display Closing LUP-->
<div class="modal fade" id="modaldisplayclosinglup{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Closing LUP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>            
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="reviewer_closing" class="col-sm col-form-label col-form-label-sm">Review By</label>
                        <div class="col-sm-4">
                            <input class="form-control form-control-sm" type="text" id="reviewer_closing" name="reviewer_closing" value="{{$lupparent->reviewer_closing}}" disabled>                                   
                        </div>                                 
                    </div> 
                    <label class="col-sm col-form-label col-form-label-sm">Verification</label>                     
                    <div class="row mb-3">
                        <label for="verified_a" class="col-sm col-form-label col-form-label-sm">a. All Necessary Documents already created/revised</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_a" id="verified_a" aria-label="Change Type" autocomplete="off" disabled>                                
                                <option value="{{$lupparent->verified_a}}" selected>{{$lupparent->verified_a}}</option>  
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>                                   
                            </select>    
                        </div>                                 
                    </div>     
                    <div class="row mb-3">
                        <label for="verified_b" class="col-sm col-form-label col-form-label-sm">b. All The Proposed Measured has been implemented</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_b" id="verified_b" aria-label="Change Type" autocomplete="off" disabled>                                
                                <option value="{{$lupparent->verified_b}}" selected>{{$lupparent->verified_b}}</option>
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>                                   
                            </select>    
                        </div>                                 
                    </div>    
                    <div class="row mb-3">
                        <label for="verified_c" class="col-sm col-form-label col-form-label-sm">c. Notification Letter / Submission / Approval from Regulatory Authority</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="verified_c" id="verified_c" aria-label="Change Type" autocomplete="off" disabled>                                
                                <option value="{{$lupparent->verified_c}}" selected>{{$lupparent->verified_c}}</option>
                                <option value="Done">Done</option>     
                                <option value="Not Yet">Not Yet</option>    
                                <option value="Not Yet">NA</option>                                  
                            </select>    
                        </div>                                 
                    </div>         
                    <div class="row mb-3">
                        <label for="approver" class="col-sm col-form-label col-form-label-sm">Approver</label>
                        <div class="col-sm-4">
                            <input class="form-control form-control-sm" area="text" list="listapprover" id="approver" name="approver" placeholder="Select Approver" autocomplete="off" value="{{$lupparent->approver_closing}}" disabled>                                               
                            <datalist id="listapprover">
                              @foreach ($listapprovers as $listapprover)                                
                                <option value="{{ $listapprover->username }}">{{ $listapprover->username }} - {{ $listapprover->name }}</option>
                              @endforeach
                          </datalist>       
                        </div>                                 
                      </div>                          
                    <div class="row mb-3">
                        <label for="closing_notes" class="col-sm col-form-label col-form-label-sm">Comments by Reviewer</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" type="text" id="closing_notes" name="closing_notes" disabled>{{$lupparent->closing_notes}}</textarea>                                   
                        </div>                                 
                    </div>      
                    <div class="row mb-3">
                        <label for="approverclosing_notes" class="col-sm col-form-label col-form-label-sm">Comments</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" type="text" id="approverclosing_notes" name="approverclosing_notes" disabled>{{$lupparent->approverclosing_notes}}</textarea>                                   
                        </div>                                 
                    </div>             
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>                   
                </div>           
      </div>
    </div>
</div>   
  
  