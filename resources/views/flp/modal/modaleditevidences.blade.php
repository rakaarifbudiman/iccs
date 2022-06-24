<!-- Modal edit evidence-->
<div class="modal fade" id="modaleditevidence{{ $flpfile->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit evidences</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/uploadattflp/{{ $flpfile->id }}/update">
          @csrf       
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="modaltxteditdocname" class="col-sm col-form-label col-form-label-sm">Document Name</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="modaltxteditdocname" name="modaltxteditdocname" value="{{ $flpfile->document_name }}" placeholder="Type File Name..." required>
                                                 
            </div>                                 
          </div>                     
          <div class="row mb-3">
            <label for="evidence_file" class="col-sm col-form-label col-form-label-sm">Select File</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="file" id="evidence_file" name="evidence_file" value="{{ $flpfile->nofile .'pdf' }}" required>
                  @error('evidence_file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror                               
            </div>                                 
          </div>    
          <div class="row mb-3">
            @include('flp.review.operation.closing_evidence')
          </div>        
           
          <input class="form-control form-control-sm" type="text" id="modalhidecodeflp" name="modalhidecodeflp" value="{{ $flp->code }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidefileid" name="modalhidefileid" value="{{ $flpfile->id }}" hidden>
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