<!-- Modal Add Action-->
<div class="modal fade" id="modaladdaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Actions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="frm_add" id="frm_add" class="form-horizontal" action="/flpaction/store">
        @csrf
        @method('put')
      <div class="modal-body">                  
        <div class="row mb-3">
          <label for="modaltxtaddaction" class="col-sm col-form-label col-form-label-sm">Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtaddaction" name="modaltxtaddaction" placeholder="Type Action Plan..." value="{{ old('modaltxtaddaction') }}" required>
                                               
          </div>                                 
        </div>    
        <div class="row mb-3">
          <label for="modaltxtaddpicaction" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listuser" id="modaltxtaddpicaction" name="modaltxtaddpicaction" placeholder="Type PIC Action..." value="{{ old('modaltxtaddpicaction') }}" required>
                <datalist id="listuser">
                    @foreach ($listusers as $listuser)
                      <option value="{{ $listuser->username }}">{{ $listuser->name }} - {{ $listuser->department }}</option>
                    @endforeach
                </datalist>                                    
          </div>                                 
        </div>             
        <div class="row mb-3">          
          <label for="modaltxtaddduedateaction" class="col-sm col-form-label col-form-label-sm">Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="modaltxtaddduedateaction" name="modaltxtaddduedateaction" placeholder="Type Due Date Action..." value="{{ old('modaltxtaddduedateaction') }}" required>
                                                  
          </div>                                 
        </div>    
        <input class="form-control form-control-sm" type="text" id="modalhidecodeflp" name="modalhidecodeflp" value="{{ $flp->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidflp" placeholder="Type to edit action..." value="{{ $flp->id }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatusflp" name="modalhidestatusflp" value="{{ $flp->flpstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Add Attachment-->
<div class="modal fade" id="modaladdattachment{{ $flp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Attachments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/uploadattflp/{{ $flp->id }}">
        @csrf       
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="modaltxtadddocname" class="col-sm col-form-label col-form-label-sm">Document Name</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtadddocname" name="modaltxtadddocname" placeholder="Type File Name..." required>
                                               
          </div>                                 
        </div>                     
        <div class="row mb-3">
          <label for="attachment_file" class="col-sm col-form-label col-form-label-sm">Select File</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="file" id="attachment_file" name="attachment_file" value="{{ old('modaltxtaddaction') }}" required>
                @error('attachment_file')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror                               
          </div>                                 
        </div>    
                
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodeflp" name="modalhidecodeflp" value="{{ $flp->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatusflp" name="modalhidestatusflp" value="{{ $flp->flpstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Add Evidence-->
<div class="modal fade" id="modaladdevidence{{ $flp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Closing Evidences</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/uploadattflp/{{ $flp->id }}">
        @csrf       
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="modaltxtadddocname" class="col-sm col-form-label col-form-label-sm">Document Name</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtadddocname" name="modaltxtadddocname" placeholder="Type File Name..." required>
                                               
          </div>                                 
        </div>                     
        <div class="row mb-3">
          <label for="evidence_file" class="col-sm col-form-label col-form-label-sm">Select File</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="file" id="evidence_file" name="evidence_file" value="{{ old('modaltxtaddaction') }}" required>
                @error('evidence_file')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror                               
          </div>                                 
        </div>    
                
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodeflp" name="modalhidecodeflp" value="{{ $flp->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatusflp" name="modalhidestatusflp" value="{{ $flp->flpstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
      </div>
    </form>
    </div>
  </div>
</div> 