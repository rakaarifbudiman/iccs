<div class="table-responsive" style="height: 50%;">
    <caption>                  
        <label class="form-check-label text-orange" for="utility_attachment">Utility/Equipment/Facility Impacted : {{ $lupparent->relatedutility->count() > 0 ? 'Yes' : 'No'  }}</label>          
    </caption>
  <table class="table table-bordered w-auto small caption-top" id="LUPTable" style="height: 50%;">        
    <thead>    
        <tr>
            <th scope="col"> No. </th>          
            <th scope="col"> Operation </th>            
            <th scope="col">Area / ID Number</th>  
            <th scope="col">Description</th>      
            <th scope="col">By</th> 
            <th scope="col">Date</th>           
                                   
        </tr>
        @can('update',$lupparent)
        <th colspan="5">
            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modaladdutility_impact{{ $lupparent->id }}" title="Add">Add <i class="ri-add-fill"></i></a>
        </th>
        @endcan
    </thead>
    
      <tbody>        
        @forelse ($lupparent->relatedutility as $index =>$relatedutility)           
        
        <tr>
            <th scope="row">{{ $index +1 }}</th> 
            <td>
                  @can('update',$lupparent)    
                          <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditutility_impact{{ $relatedutility->id }}" title="Change"><i class="ri-edit-2-fill"></i></a>                          
                          <a href="/lup/utility-impact/{{ Crypt::encryptString($relatedutility->id) }}/delete" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete"><i class=" ri-delete-bin-5-fill"></i></a>                                                
                  @endcan          
                  
              </td>
            <td>{{ $relatedutility->area }}</td>         
            <td>{{ $relatedutility->description }}</td>                    
            <td>{{ $relatedutility->uploader }}</td>
            <td>@date($relatedutility->created_at,'d-M-y')</td>                                                    
        </tr>   
        @include('lup.modal.edit.utilityimpact')
        @empty        
          
        @endforelse
     
        </tbody>
        
  </table>       
</div>
            
                                                 
                                
