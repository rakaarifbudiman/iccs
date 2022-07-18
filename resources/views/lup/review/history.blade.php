<div class="tab-pane fade history pt-0" id="history"> <!-- history Form -->
    @if($lupparent->lupstatus=="OPEN" OR $lupparent->lupstatus=="CLOSED") 
    @else 
      
    @endif  
    <div class="row">
        <div class="table-responsive">
          <table class="table datatable w-auto small" id="LUPTable">
            <thead>    
                <tr>
                    <th scope="col"> No. </th>                    
                    <th scope="col">Date Changed</th>  
                    <th scope="col">Change By.</th>             
                    <th scope="col">Activity</th>                      
                    <th class="col-sm">Before Value</th>
                    <th scope="col">After Value</th> 
                    <th scope="col">Field</th>
                    <th scope="col">Table</th>                                           
                </tr>
            </thead>            
              <tbody>    
                @forelse ($lupparent->auditlup as $index =>$auditlup)           
                <tr>
                    <th scope="row">{{ $index +1 }}</th> 
                    <td>@date($auditlup->created_at,'d-M-y H:i')</td>         
                    <td>{{ $auditlup->change_by }}</td>                    
                    <td>{{ $auditlup->activity }}</td>
                    <td class="setwidth">{!! $auditlup->beforevalue!!}</td>
                    <td class="setwidth">{!! $auditlup->aftervalue !!}</td>     
                    <td>{{ $auditlup->sourcefield }}</td>
                    <td>{{ $auditlup->sourcetable }}</td>                      
                </tr>   
                @empty             
                @endforelse
                </tbody>
          </table>       
        </div>
    </div>
</div>           <!-- End history Form --> 
                                              
                        
                        
                         
                    