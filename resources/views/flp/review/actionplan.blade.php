<div class="tab-pane fade actionplans pt-0" id="actionplans"> <!-- Action Plans Form -->
  @if($flp->flpstatus=="CREATE" OR $flp->flpstatus=="ON PROCESS") 
    <a href="#" class="btn btn-sm btn-success add" data-bs-toggle="modal" data-bs-target="#modaladdaction" title="Add Action Plan"><i class=" ri-add-fill">Add Action</i></a>  
  @else
  
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
                      
                                   
                </tr>
                <tr>
                                                           
                  <th></th>
                  @if (auth()->user()->level==1)
                    <th class="text-center">User</th>
                    <th></th>
                    <th></th>
                  @elseif (auth()->user()->level==2)
                    <th class="text-center">User</th>
                    <th class="text-center">Reviewer</th>
                    <th></th>
                  @elseif (auth()->user()->level==3)
                    <th class="text-center">User</th>
                    <th class="text-center">Reviewer</th>
                    <th class="text-center">Approver</th>
                  @endif
                                      
                  <th></th>                    
                  <th></th>
                  <th></th>                    
                  <th></th>
                  <th></th>
                  <th></th>
                  
                  
                                                           
                </tr>    
            </thead>            
              <tbody>
                
                @forelse ($flpactions as $index =>$flpaction)            
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
                      @if ($statusaction[$i]=='OVERDUE')
                        <td class="bg-danger text-white">{{ $statusaction[$i] }}</td>
                      @elseif ($statusaction[$i]=='CLOSED')
                        <td class="bg-success text-white">{{ $statusaction[$i] }}</td>
                      @elseif ($statusaction[$i]=='ON EXTENSION')
                        <td class="bg-primary text-white">{{ $statusaction[$i] }}</td>
                      @else
                        <td >{{ $statusaction[$i] }}</td>
                      @endif
                      <td>{{ $flpaction->pic_action }}</td>                    
                      <td>{{ $flpaction->pic_dept }}</td>
                      <td>@date($flpaction->signdate_action,'d-M-y')</td>                   
                      
                   
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
                        
                        
                                                              
                    
                    
                    
                    
  
                                        
                        
                                                               
                                                                        
                    
                    
                    
