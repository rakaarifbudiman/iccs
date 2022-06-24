    <div class="table-responsive">
            <caption>            
                <label class="form-check-label text-orange">Other Product Impacted : {{ $lupparent->relatedmaterial_count > 0 ? 'Yes' : 'No'  }}</label>
            </caption>
          <table class="table table-bordered w-auto small caption-top" id="LUPTable">        
              <thead>    
                  <tr>
                      <th scope="col"> No. </th>    
                      <th scope="col"> Operation </th>                
                      <th scope="col">Part No</th>  
                      <th scope="col">Description</th>             
                      <th scope="col">Site Manufacturer</th>                      
                      <th class="col-sm">Market Country</th>
                      <th scope="col">By</th> 
                      <th scope="col">Date</th>                                       
                  </tr>
                  @can('update',$lupparent)
                  <th colspan="7" class="text-small">
                      <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modaladdmaterial_impact{{ $lupparent->id }}" title="Add">Add <i class="ri-add-fill"></i></a>
                  </th>
                  @endcan
              </thead>        
              <tbody>          

                @forelse ($lupparent->relatedmaterial as $index =>$relatedmaterial)                    
                  <tr>
                      <th scope="row">{{ $index +1 }}</th> 
                        <td>
 
                            @can('update',$lupparent)      
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditmaterial_impact{{ $relatedmaterial->id }}" title="Change"><i class="ri-edit-2-fill"></i></a>                          
                                    <a href="/lup/material-impact/{{ Crypt::encryptString($relatedmaterial->id) }}/delete" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete"><i class=" ri-delete-bin-5-fill"></i></a>                           
                            @endcan                      
                            
                        </td>
                      <td>{{ $relatedmaterial->partsap }}</td>         
                      <td>{{ $relatedmaterial->partdesc }}</td>                    
                      <td>{{ $relatedmaterial->site }}</td>
                      <td>{{ $relatedmaterial->market }}</td>
                      <td>{{ $relatedmaterial->uploader }}</td>
                      <td>@date($relatedmaterial->created_at,'d-M-y')</td> 
                      
                      @include('lup.modal.edit.materialimpact')                                          
                  </tr>   
                
                @empty             
                @endforelse
              </tbody>
          </table>       
    </div>
                                                     
                                    
