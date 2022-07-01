<!-- Modal Add Evidence-->
<div class="modal fade" id="modaladdevidence{{ $lupparent->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Evidence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="upload-file" action="/lup/attachment/{{ $lupparent->id }}/uploadevidence">
            @csrf       
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="referaction" class="col-sm col-form-label col-form-label-sm">Reference Action</label>
                    <div class="col-sm-8">
                        <input class="form-control form-control-sm" list="listaction" type="text" id="referaction" name="referaction" value="{{old('referaction')}}" autocomplete="off">                                                               
                        <datalist id="listaction">
                        @foreach ($lupparent->lupaction as $index =>$lupaction)
                        <option value="{{ $lupaction->action }}">{{ $lupaction->action }} - {{ $lupaction->pic_action }} - {{ $lupaction->actionstatus }}</option>                        
                        @endforeach
                        </datalist>    
                    </div>
                </div>
            <div class="row mb-3">
                <label for="modaltxtadddocname" class="col-sm col-form-label col-form-label-sm">Evidence Name</label>
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