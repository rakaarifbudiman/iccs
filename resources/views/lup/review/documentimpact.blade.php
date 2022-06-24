<div class="table-responsive">
    <caption>            
        <label class="form-check-label text-orange">Revise Document Needed: {{ $lupparent->relateddocument_count > 0 ? 'Yes' : 'No'  }}</label>
    </caption>
  <table class="table table-bordered w-auto small caption-top" id="LUPTable">        
    <thead>    
        <tr>
            <th scope="col"> No. </th>    
            <th scope="col"> Operation </th>                  
            <th scope="col">Type</th>  
            <th scope="col">Doc Number</th>             
            <th scope="col">Doc Title</th>                    
            <th scope="col">By</th> 
            <th scope="col">Date</th>   
                                   
        </tr>
        @can('update',$lupparent)
        <th colspan="7" class="text-small">
            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modaladddocument_impact{{ $lupparent->id }}" title="Add">Add <i class="ri-add-fill"></i></a>
        </th>
        @endcan
    </thead>        
      <tbody>          
            

        @forelse ($lupparent->relateddocument as $index =>$relateddocument)        
        
        <tr>
            <th scope="row">{{ $index +1 }}</th> 
            <td>
                  @can('update',$lupparent)    
                          <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditdocument_impact{{ $relateddocument->id }}" title="Change Attachment"><i class="ri-edit-2-fill"></i></a>                          
                          <a href="/lup/document-impact/{{ Crypt::encryptString($relateddocument->id) }}/delete" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete Attachment"><i class=" ri-delete-bin-5-fill"></i></a>                           
                   @endcan                                       
                  
              </td>
            <td>{{ $relateddocument->type }}</td>         
            <td>{{ $relateddocument->doc_number }}</td>                    
            <td>{{ $relateddocument->doc_title }}</td>            
            <td>{{ $relateddocument->uploader }}</td>
            <td>@date($relateddocument->created_at,'d-M-y')</td>                                           
        </tr>   
        @include('lup.modal.edit.documentimpact')
        @empty             
        @endforelse
        </tbody>
  </table>       
</div>
                                                 
                                
