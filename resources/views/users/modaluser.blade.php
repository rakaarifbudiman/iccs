<!-- Modal Edit Department-->
<div class="modal fade" id="modaleditdepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Departments</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" name="frm_edit" id="frm_edit" class="form-horizontal" action="{{route('updatedata')}}">
          @csrf
        <div class="modal-body">                  
          <div class="row mb-3">
            <label for="modaltxteditdepartment" class="col-sm col-form-label col-form-label-sm">Department</label>
            <div class="col-sm-10">
            <input class="form-control form-control-sm" list="listdepartment" id="modaltxteditdepartment" name="modaltxteditdepartment" placeholder="Type to search Department..." value="{{ $department->department }}">
                  <datalist id="listdepartment">
                      @foreach ($departments as $index =>$department)
                      <option value="{{ $department->department }}">{{ $department->department }}</option>
                      @endforeach
                  </datalist>                                    
            </div>                                 
          </div>                                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
          <button type="submit" class="btn btn-primary" name="saveeditdepartment">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div> 

  