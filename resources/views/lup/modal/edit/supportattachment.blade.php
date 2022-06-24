<!-- Modal edit Attachment-->
<div class="modal fade" id="modaleditattachments{{ $attachment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Attachments</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/attachment/{{ $attachment->id }}/update">
          @csrf       
        <div class="modal-body">  
          <div class="row mb-3">
            <label for="modaltxteditdocname" class="col-sm col-form-label col-form-label-sm">Document Name</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="text" id="modaltxteditdocname" name="modaltxteditdocname" value="{{ $attachment->document_name }}" placeholder="Type File Name..." required>
                                                 
            </div>                                 
          </div>   

          
          <div class="row mb-3">
            <label for="attachment_file" class="col-sm col-form-label col-form-label-sm">Select File</label>
            <div class="col-sm-8">
                <input class="form-control form-control-sm" type="file" id="attachment_file" name="attachment_file" value="F2200044-ATT-001" required>
                  @error('attachment_file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror                               
            </div>                                 
          </div> 
          @if($attachment->file_path)  
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">File Already Exist, save process will be change the current file...</li> 
                  <li class="breadcrumb">Current File : {{ $attachment->org_file_name }}</li>                      
                </ol>
              </nav>           
          @endif   
               
           
          <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidepicaction" name="modalhidepicaction" value="" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidefileid" name="modalhidefileid" value="{{ $attachment->id }}" hidden>
          <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
          <button type="submit" class="btn btn-primary" name="savefile">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div> 

  