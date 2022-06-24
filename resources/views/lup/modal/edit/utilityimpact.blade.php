<!-- Modal edit utility Impact-->
<div class="modal fade" id="modaleditutility_impact{{ $relatedutility->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="utility">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Utility Impact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/utility-impact/{{ $relatedutility->id }}/update">
          @csrf  
          @method('put')     
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="modaltxtedit_area" class="col-sm col-form-label col-form-label-sm">Area / ID Number</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" area="text" id="modaltxtedit_area" name="modaltxtedit_area" placeholder="Area / ID Number" value="{{ old('modaltxtedit_area',$relatedutility->area) }}" required>                                               
            </div>                                 
          </div>   
          <div class="row mb-3">
            <label for="modaltxtedit_description" class="col-sm col-form-label col-form-label-sm">Description</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="modaltxtedit_description" name="modaltxtedit_description" placeholder="Description" value="{{ old('modaltxtedit_description',$relatedutility->description) }}" required>                                               
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