<!-- Modal Notification-->
<div class="modal fade" id="modalnotification{{ $emaillog->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Notification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>             
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="subject" class="col-sm col-form-label col-form-label-sm">Subject</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="subject" name="subject" value="{{ $emaillog->subject }}" readonly>                                                 
            </div>                                 
          </div>  
          <div class="row mb-3">
            <label for="body" class="col-sm col-form-label col-form-label-sm">Detail</label>            
            <textarea style="min-height: 300px" name="body" id="body" readonly>{!! $emaillog->body !!}</textarea>                               
          </div> 
          
          <input class="form-control form-control-sm" type="text" id="modalhideid" name="modalhideid" value="{{ $emaillog->id }}" hidden>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>          
        </div>      
      </div>
    </div>
  </div> 
          
          
          
               
           