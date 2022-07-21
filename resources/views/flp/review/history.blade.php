
<div class="tab-pane fade history pt-0" id="history"> <!-- history Form -->
    @if($flp->flpstatus=="OPEN" OR $flp->flpstatus=="CLOSED") 
    @else 
      
    @endif  
  <div class="row">
        <div class="table-responsive">
          <table class="table datatable w-auto small" id="FLPTable">
            <thead>    
                <tr>
                    <th scope="col"> No. </th>                    
                    <th scope="col">Date Changed</th>  
                    <th scope="col">Change By.</th>             
                    <th scope="col">Activity</th>  
                    <th class="col-sm">Before Value</th>
                    <th scope="col">After Value</th>   
                    <th scope="col">From Models</th>                              
                </tr>
            </thead>
            
              <tbody>
    
                @forelse ($flp->auditlup as $index =>$auditflp)           
                
                <tr>
                    <th scope="row">{{ $index +1 }}</th> 
                    <td>{{ date('d-M-Y H:m:s',strtotime($auditflp->created_at)) }}</td>         
                    <td>{{ $auditflp->username }}</td>                    
                    <td>{{ $auditflp->event }}</td>
                    <td class="setwidth">{{ $auditflp->old_values }}</td>
                    <td class="setwidth">{{ $auditflp->new_values }}</td>
                    <td>{{ $auditflp->auditable_type }}</td>                                  
                                                         
                                        
                </tr>   
                @empty             
                @endforelse
                </tbody>
              </table>       
        </div>
      </div>
</div>           <!-- End history Form --> 
                                              
                        
                        
                         
                    