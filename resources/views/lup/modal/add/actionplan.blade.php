<!-- Modal Add Action Plan-->
<div class="modal fade" id="modaladdaction{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Action Plan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/store">
          @csrf       
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." required>                                                 
            </div>                                 
          </div>      
          <div class="row mb-3">
            <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." required>                                                 
                <datalist id="listusers">
                    @foreach ($listusers as $listuser)
                    <option value="{{ $listuser->username }}">{{ $listuser->username }} - {{ $listuser->name }} - {{ $listuser->department }}</option>                        
                    @endforeach
                </datalist>
            </div>                                 
          </div>                   
          <div class="row mb-3">
            <label for="duedate_action" class="col-sm col-form-label col-form-label-sm">Due Date Action</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="date" id="duedate_action" name="duedate_action" required>
                  @error('duedate_action')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror                               
            </div>                                 
          </div>    
                  
           
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
  <!-- Modal Add Notifier-->
<div class="modal fade" id="modaladdnotif{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Notifier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updatenotif">
        @csrf       
        @method('put')
      <div class="modal-body">             
        <div class="row mb-3">
          <label for="action_notifier" class="col-sm col-form-label col-form-label-sm">PIC</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listemail" type="text" id="action_notifier" name="action_notifier" placeholder="Select PIC ..." required autocomplete="off">                                                 
              <datalist id="listemail">
                  @foreach ($listusers as $listuser)
                  <option value="{{ $listuser->email }}">{{ $listuser->username }} - {{ $listuser->name }} - {{ $listuser->department }}</option>                        
                  @endforeach
              </datalist>
          </div>                                 
        </div>       
         
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

<!-- Modal Delete Notifier-->
<div class="modal fade" id="modaldeletenotif{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Notifier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/{{Crypt::encryptString($lupparent->id)}}/deletenotif">
        @csrf       
        @method('put')
      <div class="modal-body">             
        <div class="row mb-3">
          <label for="action_notifier" class="col-sm col-form-label col-form-label-sm">PIC</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listemail" type="text" id="action_notifier" name="action_notifier" placeholder="Select PIC ..." required autocomplete="off">                                                 
              <datalist id="listemail">
                  @foreach ($listusers as $listuser)
                  <option value="{{ $listuser->email }}">{{ $listuser->username }} - {{ $listuser->name }} - {{ $listuser->department }}</option>                        
                  @endforeach
              </datalist>
          </div>                                 
        </div>       
         
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