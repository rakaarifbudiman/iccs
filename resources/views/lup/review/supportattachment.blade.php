<div class="table-responsive text-nowrap">
    <caption>                    
        <label class="form-check-label text-orange" for="support_attachment">Supportive Attachments : {{ $lupparent->lupfile_count > 0 ? 'Yes' : 'No'  }}</label>          
    </caption>    
    <table class="table table-bordered w-auto small" id="FLPAttachmentsTable">
    <thead>    
        <tr>
            <th scope="col"> No. </th>
            <th scope="col">Operation</th>
            <th scope="col">Document Title</th>  
            <th scope="col">Uploader</th>             
            <th scope="col">Date Upload</th>                                 
        </tr>
        @can('update',$lupparent)
        <th colspan="5">
          <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modaladdattachment{{ $lupparent->id }}" title="Add">Add <i class="ri-add-fill"></i></a>
        </th>
        @endcan
    </thead>
    
      <tbody>      
        @forelse ($lupparent->lupfile->where('is_evidence',false) as $index =>$attachment)          
        
        <tr>
            <th scope="row">{{$index +1 }}</th>
            <td>                                          
                @can('update',$lupparent)       
                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditattachments{{ $attachment->id }}" title="Change Attachment"><i class="ri-edit-2-fill"></i></a>                        
                        <a href="/lup/attachment/{{ Crypt::encryptString($attachment->id) }}/delete" onclick="return confirm('Are you sure want to delete this file ?');" class="btn btn-danger btn-sm" title="Delete Attachment"><i class=" ri-delete-bin-5-fill"></i></a>                           
                @endcan    
                <a href="/lup/attachment/{{ Crypt::encryptString($attachment->id) }}/download" class="btn btn-sm btn-success" title="Download Attachment" 
                  {{ $attachment->file_path ? '' : 'hidden'}}><i class=" bi-download"></i>
                </a>                                
                
            </td>
            <td>{{ $attachment->document_name }}</td>                    
            <td>{{ $attachment->uploader }}</td>
            <td> @date($attachment->created_at,'d-M-y')</td>                                      
          @include('lup.modal.edit.supportattachment')                        
        </tr>  
        @empty
        @endforelse      
       
        </tbody>
      </table>        
</div>
@include('lup.modal.add.attachment')
                                      
                
                
                 
            