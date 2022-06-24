<!-- Modal Edit Department-->
<div class="modal fade" id="modaleditdepartment{{ $relateddepartment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="utility">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Related Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($relateddepartment->id)}}/signdepartment">
          @csrf           
          @method('put') 
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="code" class="col-sm col-form-label col-form-label-sm" hidden>Code Department</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" area="text" id="code_relateddepartment" name="code" placeholder="Select Related Department" value="{{$relateddepartment->approval_code}}" hidden required autocomplete="off">                                               
                  
            </div>                                 
          </div>        
          <div class="row mb-3">
            <label for="username" class="col-sm col-form-label col-form-label-sm">Username</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" area="text" id="username_relateddepartment" name="username" value="{{$relateddepartment->username}}" required autocomplete="off" readonly>                                                                 
            </div>                                 
          </div>    
          <div class="row mb-3">
            <label for="department" class="col-sm col-form-label col-form-label-sm">Department</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" area="text" id="department_relateddepartment" name="department" value="{{$relateddepartment->department}}" required autocomplete="off" readonly>                                                                 
            </div>                                 
          </div>    
          <div class="row mb-3">
            <label for="note" class="col-sm col-form-label col-form-label-sm">Comment</label>
            <div class="col-sm-8">
                <textarea class="form-control form-control-sm" name="note" value="{{$relateddepartment->note}}" required autocomplete="off">{{$relateddepartment->note}}</textarea>                                                                
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