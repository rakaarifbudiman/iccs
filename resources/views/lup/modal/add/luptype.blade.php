<!-- Modal Edit LUP Type-->
<div class="modal fade" id="modaleditluptype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Change Related To</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body">  
            <div class="row">
                <div class="col-md-6">
                    <label>Change Related to :</label><br>
                    <div class="form-check form-switch">                                 
                    @foreach ($listtypes as $listype)                              
                        <input class="form-check-input" type="checkbox" name="lup_type[]" value="{{$listype->luptype}}">{{$listype->luptype}}                   
                                                                                                            
                    @endforeach   
                    </div>               
                </div>                   
            </div>           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>          
        </div>
      </form>
      </div>
    </div>
  </div> 

  <!-- Modal Edit LUP Sub Type-->
<div class="modal fade" id="modaleditlupsubtype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Change Sub Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body">  
            <div class="row">
                <div class="col-md-4">
                    <label>Change Sub Category :</label><br>
                    <div class="form-check form-switch">                                 
                    @foreach ($listsubtypes->skip(0)->take(20) as $listsubtype)                              
                        <input class="form-check-input" type="checkbox" name="lup_subtype[]" value="{{$listsubtype->luptype}}" 
                            >{{$listsubtype->luptype}}
                        <br>                                                                                       
                    @endforeach   
                    </div>               
                </div>   
                <div class="col-md-3">
                    <label> </label><br>
                    <div class="form-check form-switch">                                 
                    @foreach ($listsubtypes->skip(20)->take(20) as $listsubtype)                              
                        <input class="form-check-input" type="checkbox" name="lup_subtype[]" value="{{$listsubtype->luptype}}" 
                            >{{$listsubtype->luptype}}
                        <br>                                                                                       
                    @endforeach   
                    </div>               
                </div>
                <div class="col-md-5">
                    <label> </label><br>
                    <div class="form-check form-switch">                                 
                    @foreach ($listsubtypes->skip(40)->take(20) as $listsubtype)                              
                        <input class="form-check-input" type="checkbox" name="lup_subtype[]" value="{{$listsubtype->luptype}}" 
                           >{{$listsubtype->luptype}}
                        <br>                                                                                       
                    @endforeach   
                    </div>               
                </div>
            </div>           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>          
        </div>
      </form>
      </div>
    </div>
  </div> 