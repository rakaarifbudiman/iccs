<!-- Modal Edit Action Plan-->
<div class="modal fade" id="modaleditaction{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Action Plan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/update">
          @csrf       
          @method('put')
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" required>                                                 
            </div>                                 
          </div>      
          <div class="row mb-3">
            <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" required>                                                 
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
                <input class="form-control form-control-sm" type="date" id="duedate_action" name="duedate_action" value="@date($lupaction->duedate_action,'Y-m-d')" required>
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

  <!-- Modal Upload Evidence Action Plan-->
<div class="modal fade" id="modaluploadevidence{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Closing Evidence</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/uploadevidence">
        @csrf              
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>             
        <div class="row mb-3">
          <label for="evidence_uploader" class="col-sm col-form-label col-form-label-sm">Evidence Uploader</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="evidence_uploader" name="evidence_uploader" placeholder="Uploader" value="{{ $lupaction->evidence_uploader }}" disabled>                                                               
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="dateupload_evidence" class="col-sm col-form-label col-form-label-sm">Date Upload Evidence</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="dateupload_evidence" name="dateupload_evidence" value="@date($lupaction->dateupload_evidence,'d-M-y')" disabled>                                                               
          </div>                                 
        </div>            
        <div class="row mb-3">
          <label for="evidence_filename" class="col-sm col-form-label col-form-label-sm">Upload File</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="file" id="evidence_filename" name="evidence_filename" value="@date($lupaction->evidence_filename,'Y-m-d')" required>
                @error('evidence_filename')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror                               
          </div> 
          @if($lupaction->evidence_filename)   
              <div class="col-sm-1">           
                <a href="/lup/action/{{ $lupaction->id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence" 
                  {{ $lupaction->evidence_filename ? '' : 'hidden'}}><i class=" bi-download"></i>
                </a>  
              </div>               
                <nav>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">File Already Exist, save process will be change the existing file...</li>                                  
                  </ol>
                </nav>                
          @endif      
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

<!-- Modal Approved With Evidence Action Plan-->
<div class="modal fade" id="modalapprovedwithevidence{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approved Closing Evidence</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/approvedevidence">
        @csrf              
        @method('put')
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="evidence_uploader" class="col-sm col-form-label col-form-label-sm">Evidence Uploader</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="evidence_uploader" name="evidence_uploader" placeholder="Select PIC Action..." value="{{ $lupaction->evidence_uploader }}" disabled>                                                               
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="dateupload_evidence" class="col-sm col-form-label col-form-label-sm">Date Upload Evidence</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="dateupload_evidence" name="dateupload_evidence" value="@date($lupaction->dateupload_evidence,'d-M-y')" disabled>                                                               
          </div>     
          @if($lupaction->evidence_filename)   
          <div class="col-sm-1">           
            <a href="/lup/action/{{ $lupaction->id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence" 
              {{ $lupaction->evidence_filename ? '' : 'hidden'}}><i class=" bi-download"></i>
            </a>  
          </div>   
          @endif                             
        </div>   
        
        @if(!$lupaction->evidence_filename)
          <div class="row mb-3">
            <label for="referaction" class="col-sm col-form-label col-form-label-sm">Reference Action</label>
            <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listactionclose" type="text" id="referaction" name="referaction" value="{{old('referaction')}}" autocomplete="off">                                                               
              <datalist id="listactionclose">
                @foreach ($listactionclose as $actionclose)
                <option value="{{ $actionclose->action }}">{{ $actionclose->action }} - {{ $actionclose->pic_action }} - {{ $actionclose->actionstatus }}</option>                        
                @endforeach
            </datalist>
            <p class="breadcrumb-item">If the action has a reference, please select the action reference above</p>
            </div>                                 
          </div>   
        @endif
                
         
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

<!-- Modal Approved Evidence Action Plan-->
<div class="modal fade" id="modalapprovedevidence{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approved Closing Evidence</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/approvedevidence">
        @csrf              
        @method('put')
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="evidence_uploader" class="col-sm col-form-label col-form-label-sm">Evidence Uploader</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="evidence_uploader" name="evidence_uploader" placeholder="Select PIC Action..." value="{{ $lupaction->evidence_uploader }}" disabled>                                                               
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="dateupload_evidence" class="col-sm col-form-label col-form-label-sm">Date Upload Evidence</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="dateupload_evidence" name="dateupload_evidence" value="@date($lupaction->dateupload_evidence,'d-M-y')" disabled>                                                               
          </div>     
          @if($lupaction->evidence_filename)   
          <div class="col-sm-1">           
            <a href="/lup/action/{{ $lupaction->id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence" 
              {{ $lupaction->evidence_filename ? '' : 'hidden'}}><i class=" bi-download"></i>
            </a>  
          </div>   
          @endif                             
        </div>   
                     
        <div class="row mb-3">
          <label for="referaction" class="col-sm col-form-label col-form-label-sm">Reference Action</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
            <input class="form-control form-control-sm" list="listactionclose" type="text" id="referaction" name="referaction" value="{{old('referaction')}}" autocomplete="off" required>                                                               
            <datalist id="listactionclose">
              @foreach ($listactionclose as $actionclose)
              <option value="{{ $actionclose->action }}">{{ $actionclose->action }} - {{ $actionclose->pic_action }} - {{ $actionclose->actionstatus }}</option>                        
              @endforeach
          </datalist>
          <p class="breadcrumb-item">If the action has a reference, please select the action reference above</p>
          </div>                                 
        </div>           
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction" {{!$listactionclose ? 'hidden' : ''}}>Save</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Reject Evidence Action Plan-->
<div class="modal fade" id="modalrejectevidence{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject Closing Evidence</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/rejectevidence">
        @csrf              
        @method('put')
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="evidence_uploader" class="col-sm col-form-label col-form-label-sm">Evidence Uploader</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <input class="form-control form-control-sm" list="listusers" type="text" id="evidence_uploader" name="evidence_uploader" placeholder="Select PIC Action..." value="{{ $lupaction->evidence_uploader }}" disabled>                                                               
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="dateupload_evidence" class="col-sm col-form-label col-form-label-sm">Date Upload Evidence</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="dateupload_evidence" name="dateupload_evidence" value="@date($lupaction->dateupload_evidence,'d-M-y')" disabled>                                                               
          </div>               
          @if($lupaction->evidence_filename)   
          <div class="col-sm-1">           
            <a href="/lup/action/{{ $lupaction->id }}/downloadevidence" class="btn btn-sm btn-success" title="Download Closing Evidence" 
              {{ $lupaction->evidence_filename ? '' : 'hidden'}}><i class=" bi-download"></i>
            </a>  
          </div>   
          @endif                         
        </div>                  
        <div class="row mb-3">
          <label for="note" class="col-sm col-form-label col-form-label-sm">Notes</label>
          <div class="{{ $lupaction->evidence_filename ? 'col-sm-9' : 'col-sm-8'}}">
              <textarea class="form-control form-control-sm" id="note" name="note" placeholder="Add Comments" required autofocus>{{ old('note') }}</textarea>                                                            
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

<!-- Modal Submit Due Date Extension Action Plan-->
<div class="modal fade" id="modalextension{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Due Date Extension</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/storeextension">
        @csrf          
        @method('put')    
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>       
                    
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>                   
        <div class="row mb-3">
          <label for="extension_notes" class="col-sm col-form-label col-form-label-sm">Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="extension_notes" name="extension_notes" placeholder="Fill reason of due date extension..." required autofocus>{{ old('extension_notes',$lupaction->extension_notes) }}</textarea>                                                            
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="old_duedate_action" class="col-sm col-form-label col-form-label-sm">Old Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="old_duedate_action" name="old_duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->old_duedate,'Y-m-d')" disabled>                                                               
          </div>                                 
        </div>  
        <div class="row mb-3">
          <label for="duedate_action" class="col-sm col-form-label col-form-label-sm">New Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="duedate_action" name="duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->duedate_action,'Y-m-d')" required>                                                               
          </div>                                 
        </div>     
        <div class="row mb-3">
          <label for="cancel_extension_notes" class="col-sm col-form-label col-form-label-sm">Reject Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="cancel_extension_notes" name="cancel_extension_notes" placeholder="If Approver has been reject this extention, reason of reject due date extension will show here" disabled>{{ old('cancel_extension_notes',$lupaction->cancel_extension_notes) }}</textarea>                                                            
          </div>                                 
        </div>    
        <label class="col-sm col-form-label col-form-label-sm">Extended for : {{$lupaction->extension_count }} times</label>                   
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Review Due Date Extension Action Plan-->
<div class="modal fade" id="modalreviewextension{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review Due Date Extension</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/reviewextension">
        @csrf          
        @method('put')    
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>                   
        <div class="row mb-3">
          <label for="extension_notes" class="col-sm col-form-label col-form-label-sm">Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="extension_notes" name="extension_notes" placeholder="Fill reason of due date extension..." autofocus disabled>{{ old('extension_notes',$lupaction->extension_notes) }}</textarea>                                                            
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="old_duedate_action" class="col-sm col-form-label col-form-label-sm">Old Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="old_duedate_action" name="old_duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->old_duedate,'Y-m-d')" disabled>                                                               
          </div>                                 
        </div>  
        <div class="row mb-3">
          <label for="duedate_action" class="col-sm col-form-label col-form-label-sm">New Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="duedate_action" name="duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->duedate_action,'Y-m-d')">                                                               
          </div>                                 
        </div>                
        <div class="row mb-3">
          <label for="cancel_extension_notes" class="col-sm col-form-label col-form-label-sm">Reject Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="cancel_extension_notes" name="cancel_extension_notes" placeholder="If Approver has been reject this extention, reason of reject due date extension will show here" disabled>{{ old('cancel_extension_notes',$lupaction->cancel_extension_notes) }}</textarea>                                                            
          </div>                                 
        </div>    
        <label class="col-sm col-form-label col-form-label-sm">Extended for : {{$lupaction->extension_count }} times</label>       
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Submit Review</button>
      </div>
    </form>
    </div>
  </div>
</div> 
<!-- Modal Approved Due Date Extension Action Plan-->
<div class="modal fade" id="modalapprovedextension{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approved Due Date Extension</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/approvedextension">
        @csrf          
        @method('put')    
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>                   
        <div class="row mb-3">
          <label for="extension_notes" class="col-sm col-form-label col-form-label-sm">Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="extension_notes" name="extension_notes" placeholder="Fill reason of due date extension..." autofocus disabled>{{ old('extension_notes',$lupaction->extension_notes) }}</textarea>                                                            
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="old_duedate_action" class="col-sm col-form-label col-form-label-sm">Old Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="old_duedate_action" name="old_duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->old_duedate,'Y-m-d')" disabled>                                                               
          </div>                                 
        </div>  
        <div class="row mb-3">
          <label for="duedate_action" class="col-sm col-form-label col-form-label-sm">New Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="duedate_action" name="duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->duedate_action,'Y-m-d')">                                                               
          </div>                                 
        </div>    
        <div class="row mb-3">
          <label for="cancel_extension_notes" class="col-sm col-form-label col-form-label-sm">Reject Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="cancel_extension_notes" name="cancel_extension_notes" placeholder="If Approver has been reject this extention, reason of reject due date extension will show here" disabled>{{ old('cancel_extension_notes',$lupaction->cancel_extension_notes) }}</textarea>                      
          </div>                                 
        </div>       
        <label class="col-sm col-form-label col-form-label-sm">Extended for : {{$lupaction->extension_count }} times</label>                  
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-primary" name="saveaction">Approved</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Reject Due Date Extension Action Plan-->
<div class="modal fade" id="modalrejectextension{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject Due Date Extension</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/rejectextension">
        @csrf          
        @method('put')    
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>                   
        <div class="row mb-3">
          <label for="extension_notes" class="col-sm col-form-label col-form-label-sm">Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="extension_notes" name="extension_notes" placeholder="Fill reason of due date extension..." disabled>{{ old('extension_notes',$lupaction->extension_notes) }}</textarea>                                                            
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="old_duedate_action" class="col-sm col-form-label col-form-label-sm">Old Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="old_duedate_action" name="old_duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->old_duedate,'Y-m-d')" disabled>                                                               
          </div>                                 
        </div>  
        <div class="row mb-3">
          <label for="duedate_action" class="col-sm col-form-label col-form-label-sm">New Due Date</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="date" id="duedate_action" name="duedate_action" placeholder="Select PIC Action..." autocomplete="off" value="@date($lupaction->duedate_action,'Y-m-d')" disabled>                                                               
          </div>                                 
        </div>    
        <div class="row mb-3">
          <label for="cancel_extension_notes" class="col-sm col-form-label col-form-label-sm">Reject Extension Reason</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="cancel_extension_notes" name="cancel_extension_notes" placeholder="Fill reason of reject due date extension..." autofocus>{{ old('cancel_extension_notes',$lupaction->cancel_extension_notes) }}</textarea>                                                            
          </div>                                 
        </div>           
        <label class="col-sm col-form-label col-form-label-sm">Extended for : {{$lupaction->extension_count }} times</label>           
         
        <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
        <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-danger" name="saveaction">Reject</button>
      </div>
    </form>
    </div>
  </div>
</div> 

<!-- Modal Request Cancel Action Plan-->
<div class="modal fade" id="modalrequestcancelaction{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Cancel Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/requestcancelaction">
        @csrf              
        @method('put')
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>                   
        <div class="row mb-3">
          <label for="cancel_duedate_notes" class="col-sm col-form-label col-form-label-sm">Notes</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="cancel_duedate_notes" name="cancel_duedate_notes" placeholder="Add Comments" required autofocus>{{ old('cancel_duedate_notes') }}</textarea>                                                            
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


<!-- Modal Approved Cancel Action Plan-->
<div class="modal fade" id="modalapprovedcancelaction{{ $lupaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approved Cancel Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/action/{{Crypt::encryptString($lupaction->id)}}/approvedcancelaction">
        @csrf              
        @method('put')
      <div class="modal-body">  
        <div class="row mb-3">
          <label for="action" class="col-sm col-form-label col-form-label-sm">Action Plan</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" id="action" name="action" placeholder="Type Action Plan..." value="{{ $lupaction->action }}" disabled>                                                 
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="pic_action" class="col-sm col-form-label col-form-label-sm">PIC Action</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="pic_action" name="pic_action" placeholder="Select PIC Action..." value="{{ $lupaction->pic_action }}" disabled>                                                               
          </div>                                 
        </div>      
        <div class="row mb-3">
          <label for="evidence_uploader" class="col-sm col-form-label col-form-label-sm">Evidence Uploader</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="evidence_uploader" name="evidence_uploader" placeholder="Select PIC Action..." value="{{ $lupaction->evidence_uploader }}" disabled>                                                               
          </div>                                 
        </div> 
        <div class="row mb-3">
          <label for="dateupload_evidence" class="col-sm col-form-label col-form-label-sm">Date Upload Evidence</label>
          <div class="col-sm-8">
              <input class="form-control form-control-sm" list="listusers" type="text" id="dateupload_evidence" name="dateupload_evidence" value="@date($lupaction->dateupload_evidence,'d-M-y')" disabled>                                                               
          </div>                                 
        </div>                  
        <div class="row mb-3">
          <label for="cancel_duedate_notes" class="col-sm col-form-label col-form-label-sm">Reason of Cancellation</label>
          <div class="col-sm-8">
              <textarea class="form-control form-control-sm" id="cancel_duedate_notes" name="cancel_duedate_notes" placeholder="Add Comments" disabled>{{ old('cancel_duedate_notes',$lupaction->cancel_duedate_notes) }}</textarea>                                                            
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