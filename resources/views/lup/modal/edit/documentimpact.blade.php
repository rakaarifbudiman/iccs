<!-- Modal Edit Document Impact-->
<div class="modal fade" id="modaleditdocument_impact{{ $relateddocument->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Document Impact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/document-impact/{{ $relateddocument->id }}/update">
          @csrf  
          @method('put')     
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="modaltxtedit_type" class="col-sm col-form-label col-form-label-sm">Type</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="modaltxtedit_type" name="modaltxtedit_type" placeholder="Type Document" value="{{ $relateddocument->type }}" required>                                               
            </div>                                 
          </div>   
          <div class="row mb-3">
            <label for="modaltxtedit_doc_number" class="col-sm col-form-label col-form-label-sm">Document Number</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="modaltxtedit_doc_number" name="modaltxtedit_doc_number" placeholder="Document Number" value="{{ $relateddocument->doc_number }}" required>                                               
            </div>                                 
          </div> 
          <div class="row mb-3">
            <label for="modaltxtedit_doc_title" class="col-sm col-form-label col-form-label-sm">Document Title</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="modaltxtedit_doc_title" name="modaltxtedit_doc_title" placeholder="Document Title" value="{{ $relateddocument->doc_title }}" required>                                               
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