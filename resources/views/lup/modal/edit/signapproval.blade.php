<!-- Modal Sign Reviewer QSE-->
<div class="modal fade" id="modalsign_reviewer{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="utility">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sign Reviewer by QSE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/signreviewerqse">
          @csrf  
          @method('put')     
        <div class="modal-body"> 
            <div class="row mb-3">
                <label for="reviewer" class="col-sm col-form-label col-form-label-sm">Reviewer 2</label>
                <div class="col-sm-8">
                    <input class="form-control form-control-sm" area="text" list="listapprover" id="reviewer2" name="reviewer2" placeholder="Select Reviewer 2" required autocomplete="off">                                               
                    <datalist id="listapprover">
                      @foreach ($listapprovers as $listapprover)
                        <option value="{{ $listapprover->username }}">{{ $listapprover->username }} - {{ $listapprover->name }}</option>
                      @endforeach
                  </datalist>       
                </div>                                 
              </div>             
          <div class="row mb-3">
            <label for="note_reviewer" class="col-sm col-form-label col-form-label-sm">Notes</label>
            <div class="col-sm-8">
                <textarea class="form-control form-control-sm" id="note_reviewer" name="note_reviewer" placeholder="Add Comments" value="{{$lupparent->note_reviewer }}" required autofocus>{{ $lupparent->note_reviewer }}</textarea>                                                            
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
  <!-- Modal Edit Reviewer QSE-->
<div class="modal fade" id="modaledit_reviewer2{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Reviewer by QCJM</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updatereviewerqcjm">
        @csrf  
        @method('put')     
      <div class="modal-body"> 
          <div class="row mb-3">
              <label for="reviewer" class="col-sm col-form-label col-form-label-sm">Reviewer 2</label>
              <div class="col-sm-8">
                  <input class="form-control form-control-sm" area="text" list="listapprover" id="reviewer2" name="reviewer2" placeholder="Select Reviewer 2" required autocomplete="off">                                               
                  <datalist id="listapprover">
                    @foreach ($listapprovers as $listapprover)
                      <option value="{{ $listapprover->username }}">{{ $listapprover->username }} - {{ $listapprover->name }}</option>
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
        <button type="submit" class="btn btn-primary" name="saveaction">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <!-- Modal Sign Reviewer QCJM-->
<div class="modal fade" id="modalsign_reviewerqcjm{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="utility">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sign Reviewer by QCJM</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/signreviewerqcjm">
          @csrf  
          @method('put')     
        <div class="modal-body"> 
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
          <div class="row mb-3">
            <label for="note_reviewer2" class="col-sm col-form-label col-form-label-sm">Notes</label>
            <div class="col-sm-8">
                <textarea class="form-control form-control-sm" id="note_reviewer2" name="note_reviewer2" placeholder="Add Comments" value="{{$lupparent->note_reviewer2 }}" required autofocus>{{ $lupparent->note_reviewer2 }}</textarea>                                                            
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

<!-- Modal Edit Approver-->
<div class="modal fade" id="modaleditapprover{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Approver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updateapprover">
        @csrf  
        @method('put')     
      <div class="modal-body"> 
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
        <input class="form-control form-control-sm" type="text" id="modalhidedatesign_leader" name="modalhidedatesign_leader" value="@date($lupparent->datesign_leader)" hidden> 
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>


  <!-- Modal Sign Approver-->
<div class="modal fade" id="modalapprovedlup{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approved LUP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/approvedlup">
        @csrf  
        @method('put')     
      <div class="modal-body"> 
          <div class="row mb-3">
              <label for="approver" class="col-sm col-form-label col-form-label-sm">Approver</label>
              <div class="col-sm-8">
                  <input class="form-control form-control-sm" area="text" id="approver" name="approver" placeholder="Select Approver First" value="{{$lupparent->approver }}" disabled autocomplete="off">                                                                     
              </div>                                 
            </div>             
        <div class="row mb-3">
          <label for="note_approver" class="col-sm col-form-label col-form-label-sm">Comments</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="note_approver" name="note_approver" placeholder="Add Comments" value="{{$lupparent->note_approver }}" required autofocus>{{ $lupparent->note_approver }}</textarea>                                                            
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

<!-- Modal Edit Confirmer-->
<div class="modal fade" id="modaleditconfirmer{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Confirmer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updateconfirmer">
        @csrf  
        @method('put')     
      <div class="modal-body"> 
          <div class="row mb-3">
              <label for="confirmer" class="col-sm col-form-label col-form-label-sm">Confirmer</label>
              <div class="col-sm-8">
                  <input class="form-control form-control-sm" area="text" list="listapprover" id="confirmer" name="confirmer" placeholder="Select Confirmer" required autocomplete="off">                                               
                  <datalist id="listapprover">
                    @foreach ($listapprovers as $listapprover)
                      <option value="{{ $listapprover->username }}">{{ $listapprover->username }} - {{ $listapprover->name }}</option>
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
        <button type="submit" class="btn btn-primary" name="saveaction">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

 <!-- Modal Sign Confirmer-->
 <div class="modal fade" id="modalconfirmedlup{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmed LUP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/confirmedlup">
        @csrf  
        @method('put')     
      <div class="modal-body"> 
          <div class="row mb-3">
              <label for="confirmer" class="col-sm col-form-label col-form-label-sm">Confirmer</label>
              <div class="col-sm-8">
                  <input class="form-control form-control-sm" area="text" id="confirmer" name="confirmer" placeholder="Select Confirmer First" value="{{$lupparent->confirmer }}" disabled autocomplete="off">                                                                     
              </div>                                 
            </div>             
        <div class="row mb-3">
          <label for="note_confirmer" class="col-sm col-form-label col-form-label-sm">Comments</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="note_confirmer" name="note_confirmer" placeholder="Add Comments" value="{{$lupparent->note_confirmer }}" required autofocus>{{ $lupparent->note_confirmer }}</textarea>                                                            
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