<div class="tab-pane fade show active basicdata pt-3" id="basicdata">  <!-- Basic Data Form -->                
    <form class="row g-3" method="POST" action="/masterpart/{{ $masterpart->id }}/updatebasic">
      @csrf
      @method('put')
      <div class="col-md-1">
        <div class="form-floating">
          <input type="text" class="form-control text-small" name="sap_part" id="sap_part" placeholder="Part SAP" value = "{{ $masterpart->sap_part }}" required autofocus autocomplete="off">
          <label for="sap_part">Part SAP</label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-floating">
          <input type="text" class="form-control text-small" name="sap_desc" id="sap_desc" placeholder="Part Description" value = "{{ $masterpart->sap_desc }}" required autocomplete="off">
          <label for="sap_desc">Part Description</label>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-floating">
          <input type="text" class="form-control text-small" name="sap_uom" id="sap_uom" placeholder="UoM" value = "{{ $masterpart->sap_uom }}" required autocomplete="off">
          <label for="sap_uom">UoM</label>
        </div>
      </div>      
      <div class="col-md-2">
        <div class="form-floating">
          <input type="text" class="form-control" name="requester_part" id="requester_part" placeholder="requester_part" value="{{ $masterpart->requester_part }}" autocomplete="off">
          <label for="requester_part">Requester</label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-floating">
          <input type="text" class="form-control text-small" name="sap_edisi" id="sap_edisi" placeholder="Status SAP" value = "{{ $masterpart->sap_edisi }}" required autocomplete="off">
          <label for="sap_edisi">No.Edisi</label>
        </div>
      </div>
      <div class="col-2">
        <div class="form-floating">
          <input type="text" class="form-control text-small" placeholder="Material Group" name="sap_mat_group" id="sap_mat_group" value="{{ $masterpart->sap_mat_group }}" autocomplete="off">
          <label for="sap_mat_group">Mat Group</label>
        </div>
      </div>     
      <div class="col-md-1">
        <div class="form-floating">
          <input type="text" class="form-control text-small" name="old_part" id="old_part" placeholder="Status RDMS" value = "{{ $masterpart->old_part }}" autocomplete="off">
          <label for="old_part">Old Part</label>
        </div>
      </div>
      <div class="col-5">
        <div class="form-floating">
          <input type="text" class="form-control text-small" placeholder="Old Desc" name="old_desc" id="old_desc" value="{{ $masterpart->old_desc }}" autocomplete="off">
          <label for="old_desc" id="label_old_part">Old Description</label>
        </div>
      </div>      
      <div class="col-md-2">
        <div class="form-floating">
          <input type="text" class="form-control text-small" name="rdms_status_part" id="rdms_status_part" placeholder="Status RDMS" value = "{{ $masterpart->rdms_status_part }}" required autocomplete="off">
          <label for="rdms_status_part">Status RDMS</label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-floating">
          <input type="text" class="form-control text-small" name="sap_status_part" id="sap_status_part" placeholder="Status SAP" value = "{{ $masterpart->sap_status_part }}" required autocomplete="off">
          <label for="sap_status_part">Status SAP</label>
        </div>
      </div>
      <div class="col-2">
        <div class="form-floating">
          <input type="text" class="form-control text-small" placeholder="Material Type" name="sap_mat_type" id="sap_mat_type" value="{{ $masterpart->sap_mat_type }}" autocomplete="off">
          <label for="sap_mat_type">Mat Type</label>
        </div>
      </div>
      <div class="col-6">
        <div class="form-floating">
          <textarea class="form-control" placeholder="Reason of Change" name="note_change" id="note_change" style="height: 100px;" autocomplete="off">{{ $masterpart->note_change }}</textarea>
          <label for="note_change">Reason of Change</label>
        </div>
      </div>      
      <div class="col-6">
        <div class="form-floating">
          <textarea class="form-control" placeholder="Remarks" name="rdms_remarks" id="rdms_remarks" style="height: 100px;" autocomplete="off">{{ $masterpart->rdms_remarks }}</textarea>
          <label for="rdms_remarks">Remarks</label>
        </div>
      </div>      
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="dosage_form" id="dosage_form" placeholder="Dosage Forms" value="{{ $masterpart->dosage_form }}"  autocomplete="off">
          <label for="dosage_form">Dosage Forms</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="primary_packaging" id="primary_packaging" placeholder="Packaging" value="{{ $masterpart->primary_packaging }}" autocomplete="off">
          <label for="primary_packaging">Primary Packaging</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_type" id="product_type" placeholder="product_type" value="{{ $masterpart->product_type }}" autocomplete="off">
          <label for="product_type">Product Type</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_group" id="product_group" placeholder="product_group" value="{{ $masterpart->product_group }}" autocomplete="off">
          <label for="product_group">Product Group</label>
        </div>
      </div>      
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_content_box" id="product_content_box" placeholder="product_content_box" value="{{ $masterpart->product_content_box }}" autocomplete="off">
          <label for="product_content_box">Content per Box</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_bruto_box" id="product_bruto_box" placeholder="product_bruto_box" value="{{ $masterpart->product_bruto_box }}" autocomplete="off">
          <label for="product_bruto_box">Weight per Box</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_dimension_box" id="product_dimension_box" placeholder="product_dimension_box" value="{{ $masterpart->product_dimension_box }}" autocomplete="off">
          <label for="product_dimension_box">Dimension of Box</label>
        </div>
      </div>               
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_content_mstbox" id="product_content_mstbox" placeholder="product_content_mstbox" value="{{ $masterpart->product_content_mstbox }}" autocomplete="off">
          <label for="product_content_mstbox">Content per Master Box</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_bruto_mstbox" id="product_bruto_mstbox" placeholder="product_bruto_mstbox" value="{{ $masterpart->product_bruto_mstbox }}" autocomplete="off">
          <label for="product_bruto_mstbox">Weight per Master Box</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_dimension_mstbox" id="product_dimension_mstbox" placeholder="product_dimension_mstbox" value="{{ $masterpart->product_dimension_mstbox }}" autocomplete="off">
          <label for="product_dimension_mstbox">Dimension of Master Box</label>
        </div>
      </div>          
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_shelf_life" id="product_shelf_life" placeholder="product_shelf_life" value="{{ $masterpart->product_shelf_life }}" autocomplete="off">
          <label for="product_shelf_life">Shelf Life</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_batch_size" id="product_batch_size" placeholder="product_batch_size" value="{{ $masterpart->product_batch_size }}" autocomplete="off">
          <label for="product_batch_size">Batch Size</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="product_storage" id="product_storage" placeholder="product_storage" value="{{ $masterpart->product_storage }}" autocomplete="off">
          <label for="product_storage">Storage</label>
        </div>
      </div>  
      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" name="shelf_life_type" id="shelf_life_type" placeholder="shelf_life_type" value="{{ $masterpart->shelf_life_type }}" autocomplete="off">
          <label for="shelf_life_type">Shelf Life Type</label>
        </div>
      </div>                                                       
      
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">Save</button>                        
      </div>
      
    </form>         
  </div>           <!-- End Basic Data Form -->    