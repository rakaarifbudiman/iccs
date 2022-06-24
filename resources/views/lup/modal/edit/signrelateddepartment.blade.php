<!-- Modal edit Leader-->
<div class="modal fade" id="modaledit_leader{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="utility">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Leader</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updateleader">
          @csrf  
          @method('put')     
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="leader" class="col-sm col-form-label col-form-label-sm">Leader</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" area="text" list="listleader" id="leader" name="leader" placeholder="Select Leader" value="{{ $lupparent->leader }}" required autocomplete="off">                                               
                <datalist id="listleader">
                  @foreach ($listleaders as $listleader)
                    <option value="{{ $listleader->username }}">{{ $listleader->username }} - {{ $listleader->name }} - {{ $listleader->department }}</option>
                  @endforeach
              </datalist>       
            </div>                                 
          </div>                
          <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
          <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
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

  <!-- Modal Sign Leader-->
  <div class="modal fade" id="modalsign_leader{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="utility">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sign Leader</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/signleader">
          @csrf  
          @method('put')     
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="leader" class="col-sm col-form-label col-form-label-sm">Leader</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" area="text" list="listleader" id="leader" name="leader" placeholder="Select Leader First" value="{{ $lupparent->leader }}" required autocomplete="off" readonly>                                               
                <datalist id="listleader">
                  @foreach ($listleaders as $listleader)
                    <option value="{{ $listleader->username }}">{{ $listleader->username }} - {{ $listleader->name }} - {{ $listleader->department }}</option>
                  @endforeach
              </datalist>       
            </div>                                 
          </div>   
          <div class="row mb-3">
            <label for="note_leader" class="col-sm col-form-label col-form-label-sm">Notes</label>
            <div class="col-sm-8">
                <textarea class="form-control form-control-sm" id="note_leader" name="note_leader" placeholder="Add Comments" value="{{$lupparent->note_leader }}" required autofocus>{{ $lupparent->note_leader }}</textarea>                                                            
            </div>                                 
          </div>        
          <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
          <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
          <button type="submit" class="btn btn-primary" name="saveaction">Sign</button>
        </div>
      </form>
      </div>
    </div>
  </div> 

  <!-- Modal edit Regulatory Reviewer-->
<div class="modal fade" id="modaledit_regulatory_reviewer{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Regulatory Reviewer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updateregulatoryreviewer">
        @csrf  
        @method('put')     
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="regulatory_reviewer" class="col-sm col-form-label col-form-label-sm">Regulatory Reviewer</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" list="listregulatory_reviewer" id="regulatory_reviewer" name="regulatory_reviewer" placeholder="Select Regulatory Reviewer" value="{{ $lupparent->regulatory_reviewer }}" required autocomplete="off">                                               
              <datalist id="listregulatory_reviewer">
                @foreach ($listregulatory_reviewers as $listregulatory_reviewer)
                  <option value="{{ $listregulatory_reviewer->username }}">{{ $listregulatory_reviewer->username }}</option>
                @endforeach
            </datalist>       
          </div>                                 
        </div>                
        <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
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

<!-- Modal Sign regulatory_reviewer-->
<div class="modal fade" id="modalsign_regulatory_reviewer{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign Regulatory Reviewer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/signregulatoryreviewer">
        @csrf  
        @method('put')     
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="regulatory_reviewer" class="col-sm col-form-label col-form-label-sm">Regulatory Reviewer</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" list="listregulatory_reviewer" id="regulatory_reviewer" name="regulatory_reviewer" placeholder="Select Regulatory Reviewer First" value="{{ $lupparent->regulatory_reviewer }}" required autocomplete="off" readonly>                                               
              <datalist id="listregulatory_reviewer">
                @foreach ($listregulatory_reviewers as $listregulatory_reviewer)
                  <option value="{{ $listregulatory_reviewer->username }}">{{ $listregulatory_reviewer->username }}</option>
                @endforeach
            </datalist>       
          </div>                                 
        </div>   
        <div class="row mb-3">
          <label for="regulatory_approver" class="col-sm col-form-label col-form-label-sm">Regulatory Approver</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" list="listregulatory_approver" id="regulatory_approver" name="regulatory_approver" placeholder="Select Regulatory Approver" value="{{ $lupparent->regulatory_approver }}" required autocomplete="off">                                               
              <datalist id="listregulatory_approver">
                @foreach ($listregulatory_approvers as $listregulatory_approver)
                  <option value="{{ $listregulatory_approver->username }}">{{ $listregulatory_approver->username }}</option>
                @endforeach
            </datalist>       
          </div>  
        </div>
        <div class="row mb-3">
          <label for="note_regulatory_reviewer" class="col-sm col-form-label col-form-label-sm">Notes</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="note_regulatory_reviewer" name="note_regulatory_reviewer" placeholder="Add Comments" value="{{$lupparent->note_regulatory_reviewer }}" required autofocus>{{ $lupparent->note_regulatory_reviewer }}</textarea>                                                            
          </div>                                 
        </div>        
        <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Sign</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal edit Regulatory approver-->
<div class="modal fade" id="modaledit_regulatory_approver{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Regulatory Approver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updateregulatoryapprover">
        @csrf  
        @method('put')     
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="regulatory_approver" class="col-sm col-form-label col-form-label-sm">Regulatory Approver</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" list="listregulatory_approver" id="regulatory_approver" name="regulatory_approver" placeholder="Select Regulatory Approver" value="{{ $lupparent->regulatory_approver }}" required autocomplete="off">                                               
              <datalist id="listregulatory_approver">
                @foreach ($listregulatory_approvers as $listregulatory_approver)
                  <option value="{{ $listregulatory_approver->username }}">{{ $listregulatory_approver->username }}</option>
                @endforeach
            </datalist>       
          </div>                                 
        </div>                
        <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
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

<!-- Modal Sign regulatory_approver-->
<div class="modal fade" id="modalsign_regulatory_approver{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign Regulatory Approver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/signregulatoryapprover">
        @csrf  
        @method('put')     
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="regulatory_approver" class="col-sm col-form-label col-form-label-sm">Regulatory Approver</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" list="listregulatory_approver" id="regulatory_approver" name="regulatory_approver" placeholder="Select Regulatory Approver First" value="{{ $lupparent->regulatory_approver }}" required autocomplete="off" readonly>                                               
              <datalist id="listregulatory_approver">
                @foreach ($listregulatory_approvers as $listregulatory_approver)
                  <option value="{{ $listregulatory_approver->username }}">{{ $listregulatory_approver->username }}</option>
                @endforeach
            </datalist>       
          </div>                                 
        </div>   
        <div class="row mb-3">
          <label for="note_regulatory_approver" class="col-sm col-form-label col-form-label-sm">Notes</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="note_regulatory_approver" name="note_regulatory_approver" placeholder="Add Comments" value="{{$lupparent->note_regulatory_approver }}" required autofocus>{{ $lupparent->note_regulatory_approver }}</textarea>                                                            
          </div>                                 
        </div>        
        <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Sign</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Edit External Party-->
<div class="modal fade" id="modaledit_external_party{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit External Party</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updateexternalparty">
        @csrf  
        @method('put')     
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="external_party_name" class="col-sm col-form-label col-form-label-sm">External Party</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" id="external_party_name" name="external_party_name" placeholder="Type External Party Name" value="{{ $lupparent->external_party_name }}" required autocomplete="off">                                                                 
          </div>                                 
        </div>  
        <div class="row mb-3">
          <label for="note_external_party" class="col-sm col-form-label col-form-label-sm">Notes</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="note_external_party" name="note_external_party" placeholder="Add Comments" value="{{$lupparent->note_external_party }}" required autofocus>{{ $lupparent->note_external_party }}</textarea>                                                            
          </div>                                 
        </div>       
          
        <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
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

<!-- Modal Add Department-->
<div class="modal fade" id="modaladddepartment{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Related Department</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/storedepartment">
        @csrf            
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="code" class="col-sm col-form-label col-form-label-sm">Code Department</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" list="listdepartment" id="code_relateddepartment" name="code" placeholder="Select Related Department" required autocomplete="off">                                               
              <datalist id="listdepartment">
                @foreach ($listdepartments as $listdepartment)
                  <option value="{{ $listdepartment->code }}">{{ $listdepartment->username }} - {{ $listdepartment->type }}</option>
                @endforeach
            </datalist>       
          </div>                                 
        </div>        
        <div class="row mb-3">
          <label for="username" class="col-sm col-form-label col-form-label-sm">Username</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" id="username_relateddepartment" name="username" required autocomplete="off" readonly>                                                                 
          </div>                                 
        </div>    
        <div class="row mb-3">
          <label for="department" class="col-sm col-form-label col-form-label-sm">Department</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" id="department_relateddepartment" name="department" required autocomplete="off" readonly>                                                                 
          </div>                                 
        </div>           
        <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
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

