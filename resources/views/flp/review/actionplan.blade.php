<div class="tab-pane fade actionplans pt-0" id="actionplans"> <!-- Action Plans Form -->
  @if($flp->lupstatus=="CREATE" OR $flp->lupstatus=="ON PROCESS") 
    <a href="#" class="btn btn-sm btn-success add" data-bs-toggle="modal" data-bs-target="#modaladdaction" title="Add Action Plan"><i class=" ri-add-fill">Add Action Plan</i></a>  
  @endif  
  <div class="row">
        <div class="table-responsive text-nowrap">
            <table class="table datatable w-auto small" id="FLPActionTable">
            <thead>    
                <tr>
                    <th scope="col" > No. </th>                    
                    <th scope="col" colspan="3" class="text-center">Operation</th>                    
                    <th scope="col" class="text-center">Action</th>  
                    <th scope="col">Due Date</th>
                    <th scope="col">Status Action</th>             
                    <th scope="col">PIC Action</th>
                    <th scope="col">Department</th>
                    <th scope="col">Sign Date</th>  
                    <th scope="col">Sign Type</th>                   
                      
                                   
                </tr>                
            </thead>            
              <tbody>
                
                @forelse ($flp->lupaction as $index =>$flpaction)            
                      <tr>
                        <th>{{ $index +1 }} </th>
                
                      
                        @php
                          $id= Crypt::encryptString($flpaction->action_id);
                          $i=$index;
                        @endphp                    
                                            
                      
                              <td>@include('flp.review.operation.useraction')</td>
                              <td>@include('flp.review.operation.revieweraction')</td>
                              <td>@include('flp.review.operation.approveraction')</td>  
                            
                      

                      <td>{{ $flpaction->action }}</td>                    
                      <td>@date($flpaction->duedate_action,'d-M-y')</td>
                      <td class="{{$flpaction->statusaction=='OVERDUE' ? "bg-danger text-white" : 
                        ($flpaction->statusaction=='CLOSED' ? "bg-success text-white" : 
                        ($flpaction->statusaction=='ON EXTENSION' ? "bg-primary text-white" :
                        ""))
                      }}">{{ $flpaction->statusaction }}</td>  
                      <td>{{ $flpaction->pic_action }}</td>                                                
                      <td>{{(!$flpaction->pic_action || !$flpaction->pic->department) ? '' : $flpaction->pic->department}}</td>            
                      <td>@date($flpaction->signdate_action,'d-M-y')</td>    
                      <td>{{$flpaction->sign_type}}</td>                 
                      
                   
                  </tr>  
                  @include('flp.modal.modalflp')                  
                  @empty                
                  @endforelse
                  
                </tbody>
              </table>        
        </div>
      </div>
</div>           <!-- End Action Plans Form --> 
@include('flp.modal.modaladdactionflp')
                        
                        
                                                              
                    
                    
                    
                    
  
                                        
                        
                                                               
                                                                        
                    
                    
                    
