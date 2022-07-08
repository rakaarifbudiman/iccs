<!-- Modal Edit LUP Type-->
<div class="modal fade" id="modaleditluptype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Change Related To</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body">  
            <div class="row">
                            
                    <div class="col-sm-6">
                      <label>Change Related to :</label><br>                      
                        @foreach ($listtypes->skip(0)->take(8) as $listype)
                            <div class="row">
                              <div class="col-md">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="lup_type[]" value="{{$listype->luptype}}">{{$listype->code}}. {{$listype->luptype}}                                    
                                </div>
                                @foreach ($listsubtypes->where('code',$listype->code) as $listsubtype)
                                  <div class="col-md mx-5">
                                    <div class="form-check form-switch">                                                          
                                      <input class="form-check-input" type="checkbox" name="lup_subtype[]" value="{{$listsubtype->luptype}}" 
                                      > {{$listsubtype->luptype}}                                                           
                                    </div>                                                  
                                  </div>
                                @endforeach 
                              </div>                              
                            </div>  
                        @endforeach                      
                    </div>
                    <div class="col-sm-6">
                      <label> </label><br>                      
                        @foreach ($listtypes->skip(8) as $listype)
                            <div class="row">
                              <div class="col-md">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="lup_type[]" value="{{$listype->luptype}}">{{$listype->code}}. {{$listype->luptype}}                                    
                                </div>
                                @foreach ($listsubtypes->where('code',$listype->code) as $listsubtype)
                                  <div class="col-md mx-5">
                                    <div class="form-check form-switch">                                                          
                                      <input class="form-check-input" type="checkbox" name="lup_subtype[]" value="{{$listsubtype->luptype}}" 
                                      > {{$listsubtype->luptype}}                                                           
                                    </div>                                                  
                                  </div>
                                @endforeach 
                              </div>                              
                            </div>  
                        @endforeach                      
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
                       

  