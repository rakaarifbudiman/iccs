<!-- Modal Edit Categorization-->
<div class="modal fade" id="modaleditcategorization{{$lupparent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adjust Categorization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="frm-categorization" id="frm-categorization" class="form-horizontal" action="/lup/{{Crypt::encryptString($lupparent->id)}}/updatecategorization">
                @csrf
                @method('put')
                <div class="modal-body">                
                    <div class="row mb-3">
                        <label for="categorization" class="col-sm col-form-label col-form-label-sm">Categorization</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="categorization" id="categorization" aria-label="Change Type" required autocomplete="off">
                                <option selected>{{$lupparent->categorization}}</option> 
                                <option value="Minor">Minor</option>     
                                <option value="Major">Major</option>   
                                <option value="Critical">Critical</option>  
                            </select>                                            
                        </div>                                 
                    </div>                      
                    <input class="form-control form-control-sm" type="text" id="modalhidecodelup" name="modalhidecodelup" value="{{ $lupparent->code }}" hidden>
                    <input class="form-control form-control-sm" type="text" id="modalhidecode" name="modalhideidlup" placeholder="Type to edit action..." value="{{ $lupparent->id }}" hidden>
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
  