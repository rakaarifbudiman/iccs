<!-- Multi Evidence Action Plan Form -->  
<div class="row">   
  <div class="table-responsive">  
    <caption>                    
        <label class="form-check-label text-orange" for="support_attachment">This is for multiple evidence action requirement</label>          
    </caption>    
    <table class="table table-bordered w-auto small" id="FLPAttachmentsTable">
    <thead>    
        <tr>
            <th scope="col"> No. </th>
            <th scope="col">Operation</th>
            <th scope="col">Action</th>
            <th scope="col">Evidence Name</th>  
            <th scope="col">Uploader</th>             
            <th scope="col">Date Upload</th>                                 
        </tr>       
        <th colspan="5">
          <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modaladdevidence{{ $lupparent->id }}" title="Add">Add <i class="ri-add-fill"></i></a>
        </th>        
    </thead>
    
      <tbody>      
        @forelse ($lupparent->lupfile->sortby('action')->where('is_evidence',true) as $index =>$attachment)          
        
        <tr>
            <th scope="row">{{$index - $lupparent->lupfile->where('is_evidence',false)->count() +1 }}</th>
            <td>           
              <a href="/lup/attachment/{{ Crypt::encryptString($attachment->id) }}/download" class="btn btn-sm btn-success" title="Download Attachment" 
                {{ $attachment->file_path ? '' : 'hidden'}}><i class=" bi-download"></i>
              </a>                                
                @can('update',$lupparent)                        
                        <a href="/lup/attachment/{{ Crypt::encryptString($attachment->id) }}/delete" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete Attachment"><i class=" ri-delete-bin-5-fill"></i></a>                           
                @endcan       
                
            </td>
            <td>{{ $attachment->action }}</td> 
            <td>{{ $attachment->document_name }}</td>                    
            <td>{{ $attachment->uploader }}</td>
            <td> @date($attachment->created_at,'d-M-y')</td>                                      
                        
        </tr>  
        @empty
        @endforelse      
        </tbody>
      </table>     
      @include('lup.modal.add.evidence')   
</div>
</div>
<!-- End Multi Evidence Action Plan Form -->   