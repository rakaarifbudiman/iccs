<!-- Modal Add Attachment-->
<div class="modal fade" id="modaladdattachment{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Attachments</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/attachment/{{ $lupparent->id }}/upload">
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
                  
           
          <input class="form-control form-control-sm" type="text" id="modalhidecodeflp" name="modalhidecodeflp" value="{{ $lupparent->code }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidestatusflp" name="modalhidestatusflp" value="{{ $lupparent->lupstatus }}" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
          <button type="submit" class="btn btn-primary" name="saveaction">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div> 


  <!-- Modal Add Document Impact-->
<div class="modal fade" id="modaladddocument_impact{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Document Impact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/document-impact/{{ $lupparent->id }}/store">
        @csrf       
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="modaltxtadd_type" class="col-sm col-form-label col-form-label-sm">Type</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtadd_type" name="modaltxtadd_type" placeholder="Type Document" required>                                               
          </div>                                 
        </div>   
        <div class="row mb-3">
          <label for="modaltxtadd_doc_number" class="col-sm col-form-label col-form-label-sm">Document Number</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtadd_doc_number" name="modaltxtadd_doc_number" placeholder="Document Number" required>                                               
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="modaltxtadd_doc_title" class="col-sm col-form-label col-form-label-sm">Document Title</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtadd_doc_title" name="modaltxtadd_doc_title" placeholder="Document Title" required>                                               
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

<!-- Modal Add material Impact-->
<div class="modal fade" id="modaladdmaterial_impact{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="material">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product Impact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/material-impact/{{ $lupparent->id }}/store">
        @csrf       
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="modaltxtadd_partsap" class="col-sm col-form-label col-form-label-sm">Part No.</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" partsap="text" id="modaltxtadd_partsap" name="modaltxtadd_partsap" placeholder="Part No." required>                                               
          </div>                                 
        </div>   
        <div class="row mb-3">
          <label for="modaltxtadd_partdesc" class="col-sm col-form-label col-form-label-sm">Description</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtadd_partdesc" name="modaltxtadd_partdesc" placeholder="Description" required>                                               
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

<!-- Modal Add utility Impact-->
<div class="modal fade" id="modaladdutility_impact{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="utility">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Utility Impact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/utility-impact/{{ $lupparent->id }}/store">
        @csrf       
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="modaltxtadd_area" class="col-sm col-form-label col-form-label-sm">Area / ID Number</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" area="text" id="modaltxtadd_area" name="modaltxtadd_area" placeholder="Area / ID Number" required>                                               
          </div>                                 
        </div>   
        <div class="row mb-3">
          <label for="modaltxtadd_description" class="col-sm col-form-label col-form-label-sm">Description</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="modaltxtadd_description" name="modaltxtadd_description" placeholder="Description" required>                                               
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