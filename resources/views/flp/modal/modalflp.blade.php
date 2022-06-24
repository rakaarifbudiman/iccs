<!-- Modal Edit Action-->
<div class="modal fade" id="modaleditaction{{ $flpaction->action_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Actions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="frm_edit" id="frm_edit" class="form-horizontal" action="/flpaction/{{ $flpaction->action_id }}/update">
          @csrf
          @method('put')
        <div class="modal-body">                  
          <div class="row mb-3">
            <label for="modaltxteditaction" class="col-sm col-form-label col-form-label-sm">Action</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="modaltxteditaction" name="modaltxteditaction" placeholder="Type to edit action..." value="{{ $flpaction->action }}" required>
                                                 
            </div>                                 
          </div>    
          <div class="row mb-3">
            <label for="modaltxteditpicaction" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" list="listuser" id="modaltxteditpicaction" name="modaltxteditpicaction" placeholder="Type to edit PIC Action..." value="{{ $flpaction->pic_action }}" required>
                  <datalist id="listuser">
                      @foreach ($listusers as $listuser)
                        <option value="{{ $listuser->username }}">{{ $listuser->name }} - {{ $listuser->department }}</option>
                      @endforeach
                  </datalist>                                    
            </div>                                 
          </div>             
          <div class="row mb-3">
            @php 
            if (!$flpaction->duedate_action){
              $duedate = null;
            } else {
              $duedate = date('Y-m-d',strtotime($flpaction->duedate_action));
            }
            @endphp
            <label for="modaltxteditduedateaction" class="col-sm col-form-label col-form-label-sm">Due Date</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="date" id="modaltxteditduedateaction" name="modaltxteditduedateaction" placeholder="Type to edit Due Date Action..." value="{{ $duedate }}" required>
                                                    
            </div>                                 
          </div>    
          <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhidecode" placeholder="Type to edit action..." value="{{ $flpaction->code }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidesigndate" name="modalhidesigndate" placeholder="Type to edit action..." value="{{ $flpaction->signdate_action }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" placeholder="Type to edit action..." value="{{ $flpaction->pic_action }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidestatusaction" name="modalhidestatusaction" placeholder="Type to edit action..." value="{{ $statusaction[$i] }}" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
          <button type="submit" class="btn btn-primary" name="saveeditaction">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div> 

<!-- Modal upload evidence-->
<div class="modal fade" id="modaluploadevidence{{ $flpaction->action_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Closing Evidences</h5>        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/flpaction/{{ $flpaction->action_id }}/uploadevidence">
        @csrf       
      <div class="modal-body">  
        
        <div class="row mb-3">
          <label class="col-sm col-form-label col-form-label-sm">Action</label> 
          <div class="col-sm-8">
            <label class="col-sm col-form-label col-form-label-sm">{{ $flpaction->action }}</label>                               
          </div>                              
        </div>      
        <div class="row mb-3">
          <label for="evidence_file" class="col-sm col-form-label col-form-label-sm">Select File</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="file" id="evidence_file" name="evidence_file" value="" required>
                @error('evidence_file')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror                               
          </div>                                 
        </div>                   
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodeflp" name="modalhidecodeflp" value="{{ $flp->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidefileid" name="modalhidefileid" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatusflp" name="modalhidestatusflp" value="{{ $flp->flpstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="savefile">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>   