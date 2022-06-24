<!-- Modal Call FLP-->
<div class="modal fade" id="modalcallflp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search FLP by code</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="frm_search_flp" id="frm_search_flp" class="form-horizontal" action="/flpaction/store">
        @csrf
        @method('put')
      <div class="modal-body">                 
        
        <div class="row mb-3">
          <label for="modaltxtcodeflp" class="col-sm col-form-label col-form-label-sm">Code FLP</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listuser" id="modaltxtcodeflp" name="modaltxtcodeflp" placeholder="Type PIC Action..." value="" required>
                <datalist id="listuser">
                   
                </datalist>                                    
          </div>                                 
        </div>            
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="searchflp">Save</button>
      </div>
    </form>
    </div>
  </div>
</div> 
  