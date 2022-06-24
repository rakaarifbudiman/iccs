<!-- Modal Edit approver-->
<div class="modal fade" id="modaleditapprover{{ $flp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Approver</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="frm_edit" id="frm_edit" class="form-horizontal" action="/flp/{{ $flp->id }}/updateapprover">
          @csrf
          @method('put')
        <div class="modal-body">                  
          <div class="row mb-3">
            <label for="modaltxteditapprover" class="col-sm col-form-label col-form-label-sm">Approver</label>
            <div class="col-sm-10">
            <input class="form-control form-control-sm" list="listapprover" id="modaltxteditapprover" name="modaltxteditapprover" placeholder="Type to search approver..." value="{{ $flp->approver }}" autocomplete="off">
                  <datalist id="listapprover">
                    @foreach ($listapprovers as $listapprover)
                    <option value="{{ $listapprover->username }}">{{ $listapprover->name }} - {{ $listapprover->department }}</option>
                  @endforeach 
                  </datalist>                                    
            </div>                                 
          </div>                                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
          <button type="submit" class="btn btn-primary" name="saveeditapprover">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div> 

<!-- Modal Approved FLP-->
<div class="modal fade" id="modalapprovedflp{{ $flp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approved FLP ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="frm_edit" id="frm_edit" class="form-horizontal" action="/flp/{{ $flp->id }}/approvedflp">
        @csrf
        @method('put')
      <div class="modal-body">                  
        <div class="row mb-3">
          <label for="modaltxteditnotes" class="col-sm col-form-label col-form-label-sm">Notes</label>
          <div class="col-sm-10">
            <textarea class="form-control" placeholder="Notes" name="modaltxteditnotes" id="modaltxteditnotes" style="height: 100px;" required></textarea>
                                                   
          </div>                                 
        </div>                                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveeditapprover">Save</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Edit Leader-->
<div class="modal fade" id="modaleditleader{{ $flp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Leader</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="frm_edit" id="frm_edit" class="form-horizontal" action="/flp/{{ $flp->id }}/updateleader">
        @csrf
        @method('put')
      <div class="modal-body">                  
        <div class="row mb-3">
          <label for="modaltxteditleader" class="col-sm col-form-label col-form-label-sm">Leader</label>
          <div class="col-sm-10">
          <input class="form-control form-control-sm" list="listleader" id="modaltxteditleader" name="modaltxteditleader" placeholder="Type to search Leader..." value="{{ $flp->leader }}" autocomplete="off">
                <datalist id="listleader">
                  @foreach ($listleaders as $listleader)
                  <option value="{{ $listleader->username }}">{{ $listleader->name }} - {{ $listleader->department }}</option>
                @endforeach 
                </datalist>                                    
          </div>                                 
        </div>                                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveeditleader">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>   
  