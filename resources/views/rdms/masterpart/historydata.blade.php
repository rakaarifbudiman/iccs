<div class="tab-pane fade historydata pt-3" id="historydata">  <!-- history Data Form -->   
    <div class="table-responsive">
        <table class="table datatable w-auto small" id="RDMSHistoryTable">
          <thead>    
              <tr>
                  <th scope="col"> No. </th>                    
                  <th scope="col">Date Changed</th>  
                  <th scope="col">ID</th>
                  <th scope="col">Change By.</th>  
                  <th scope="col">Fields</th>          
                  <th class="col-sm">Old Value</th>
                  <th class="col-sm">New Value</th>
                  <th scope="col">Updated ?</th>  
                  <th scope="col">Updated at</th>  
                  <th scope="col">Updated by</th>  
                                               
                   
              </tr>
          </thead>
          
            <tbody>
  
              @forelse ($history as $index =>$data)           
              
              <tr data-value={{ $data->id }}>
                  <th scope="row" >{{ $index +1 }} </th> 
                  <td>@date($data->created_at,'d-M-y')</td>   
                  <td>{{ $data->id }}</td>   
                  <td>{{ $data->change_by }}</td>                                    
                  <td class="update" data-name="sourcefield" id="sourcefield" data-type="text" data-pk="{{ $data->id }}" data-value="{{ $data->sourcefield }}">{{ $data->sourcefield }}</td>
                  <td class="update">{{ $data->beforevalue }}</td>
                  <td class="update">{{ $data->aftervalue }}</td>
                  @if ($data->updated==0)
                    <td data-id="{{ $data->id }}"><input  type="checkbox" value="{{ $data->updated }}"></td> 
                  @else
                    <td data-id="{{ $data->id }}"><input checked="checked" type="checkbox" value="{{ $data->updated }}"></td> 
                  @endif          
                  <td class="setwidth">@date($data->inputsap_at,'d-M-y')</td>  
                  <td class="setwidth">{{ $data->updated_by }}</td>                              
                                                       
                                      
              </tr>   
              @empty             
              @endforelse
              </tbody>
            </table>       
      </div>   
        
 
</div>