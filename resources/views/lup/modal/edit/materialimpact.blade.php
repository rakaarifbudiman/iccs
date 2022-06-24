<!-- Modal edit material Impact for dummy-->

<div class="modal fade" id="modaledit2material_impact{{ $relatedmaterial->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="material">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product Impact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
          <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="modaleditmaterial_impact_form" action="/lup/material-impact/{{ $relatedmaterial->id }}/delete">
            @csrf      
            @method('put') 
            <div class="modal-body">  
              <div class="row mb-3">
                <label for="modaltxtedit_partsap" class="col-sm col-form-label col-form-label-sm">Part No.</label>
                <div class="col-sm-8">
                    <input class="form-control form-control-sm" partsap="text" id="modaltxtedit2_partsap" name="modaltxtedit2_partsap" placeholder="Part No." value="{{ old('modaltxtedit2_partsap',$relatedmaterial->partsap) }}" required>                                               
                </div>                                 
              </div>   
              <div class="row mb-3">
                <label for="modaltxtedit2_partdesc" class="col-sm col-form-label col-form-label-sm">Description</label>
                <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text" id="modaltxtedit2_partdesc" name="modaltxtedit2_partdesc" placeholder="Description" value="{{ old('modaltxtedit2_partdesc',$relatedmaterial->partdesc) }}" required>                                               
                </div>                                 
              </div> 
              <div class="row mb-3">
                <label for="modaltxtedit2_site" class="col-sm col-form-label col-form-label-sm">Site</label>
                <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text" id="modaltxtedit2_site" name="modaltxtedit2_site" placeholder="Site" value="{{ old('modaltxtedit2_site',$relatedmaterial->site) }}">                                               
                </div>                                 
              </div>    
              <div class="row mb-3">
                <label for="modaltxtedit2_market" class="col-sm col-form-label col-form-label-sm">Market</label>
                <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text" id="modaltxtedit2_market" name="modaltxtedit2_market" placeholder="Market" value="{{ old('modaltxtedit2_market',$relatedmaterial->market) }}">                                               
                </div>                                 
              </div>            
              <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>          
              <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
            </div>
            <div class="modal-footer">  
              <a href="#" onclick="event.preventDefault(); document.getElementById('modaledit2material_impact_form').submit();" title="Save"><i class="ri-save-3-fill"></i></a>          
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>   
              <button type="submit" class="btn btn-primary" name="save">Save</button>         
            </div>
        </form>
    </div>
  </div>
</div> 


<!-- Modal edit material Impact-->

  <div class="modal fade" id="modaleditmaterial_impact{{ $relatedmaterial->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="material">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Product Impact</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
              <form method="POST" name="upload-file" class="form-horizontal" enctype="multipart/form-data" id="modaleditmaterial_impact_form" action="/lup/material-impact/{{ $relatedmaterial->id }}/update">
                @csrf      
                @method('put') 
                <div class="modal-body">  
                  <div class="row mb-3">
                    <label for="modaltxtedit_partsap" class="col-sm col-form-label col-form-label-sm">Part No.</label>
                    <div class="col-sm-8">
                        <input class="form-control form-control-sm" partsap="text" id="modaltxtedit_partsap" name="modaltxtedit_partsap" placeholder="Part No." value="{{ old('modaltxtedit_partsap',$relatedmaterial->partsap) }}" required>                                               
                    </div>                                 
                  </div>   
                  <div class="row mb-3">
                    <label for="modaltxtedit_partdesc" class="col-sm col-form-label col-form-label-sm">Description</label>
                    <div class="col-sm-8">
                        <input class="form-control form-control-sm" type="text" id="modaltxtedit_partdesc" name="modaltxtedit_partdesc" placeholder="Description" value="{{ old('modaltxtedit_partdesc',$relatedmaterial->partdesc) }}" required>                                               
                    </div>                                 
                  </div> 
                  <div class="row mb-3">
                    <label for="modaltxtedit_site" class="col-sm col-form-label col-form-label-sm">Site</label>
                    <div class="col-sm-8">
                        <input class="form-control form-control-sm" type="text" id="modaltxtedit_site" name="modaltxtedit_site" placeholder="Site" value="{{ old('modaltxtedit_site',$relatedmaterial->site) }}">                                               
                    </div>                                 
                  </div>    
                  <div class="row mb-3">
                    <label for="modaltxtedit_market" class="col-sm col-form-label col-form-label-sm">Market</label>
                    <div class="col-sm-8">
                        <input class="form-control form-control-sm" type="text" id="modaltxtedit_market" name="modaltxtedit_market" placeholder="Market" value="{{ old('modaltxtedit_market',$relatedmaterial->market) }}">                                               
                    </div>                                 
                  </div>            
                  <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>          
                  <input class="form-control form-control-sm" type="text" id="modalhidestatuslup" name="modalhidestatuslup" value="{{ $lupparent->lupstatus }}" hidden>
                </div>
                <div class="modal-footer">                    
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>   
                  <button type="submit" class="btn btn-primary" name="save">Save</button>         
                </div>
            </form>
        </div>
      </div>
    </div> 
