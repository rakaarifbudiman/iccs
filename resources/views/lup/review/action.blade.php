<div class="tab-pane fade action pt-0" id="action"> <!-- action Form -->    
    <div class="row">    
        <div class="table-responsive">                            
            <a href="#" class="btn btn-sm btn-success text-white" data-bs-toggle="modal" data-bs-target="#modaladdaction{{ $lupparent->id }}" title="Add Action Plan" 
                {{$lupparent->lupstatus=="APPROVED" ? : 'hidden'}}>
                Add Action Plan<i class="ri-add-fill"></i>
            </a>                           
            {{-- <a href="#" class="btn btn-sm btn-success text-white" data-bs-toggle="modal" data-bs-target="#modaladdnotif{{ $lupparent->id }}" title="Add Notification" 
                {{$lupparent->lupstatus=="APPROVED" ? : 'hidden'}}>
                Add Notification<i class="ri-add-fill"></i>
            </a>                           
            <a href="#" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modaldeletenotif{{ $lupparent->id }}" title="Delete Notification" 
              {{$lupparent->lupstatus=="APPROVED" ? : 'hidden'}}>
                Delete Notification<i class="ri-delete-bin-2-fill"></i>
            </a> --}}
            @can('sendnotif',$lupparent)
              <a href="/lup/action/{{Crypt::encryptString($lupparent->id)}}/sendnotif" onclick="return confirm('Send notif to all PIC Action ?');" class="btn btn-sm btn-primary text-white"  title="Send Mail to All PIC Action" 
                {{$lupparent->lupstatus=="APPROVED" ? : 'hidden'}}>
                  <i class="ri-mail-send-line"></i>
              </a>
            @endcan
            

          <table class="table datatable w-auto small" id="LUPTable">
            <thead>    
                <tr>
                    <th scope="col"> No. </th>        
                    <th scope="col-md-2">Operation</th>            
                    <th scope="col">Action</th>  
                    <th scope="col">PIC</th>             
                    <th scope="col">Sign Date</th>                      
                    <th class="col-sm">Due Date</th>
                    <th scope="col">Status</th>    
                    <th scope="col">Sign Type</th>  
                    <th scope="col">Department</th>
                </tr>
            </thead>            
              <tbody>
                @include('lup.modal.add.actionplan')           
    
                @forelse ($lupparent->lupaction as $index =>$lupaction)          
                
                <tr>
                    <th scope="row">{{ $index +1 }}</th> 
                    <th scope="row">                       
                      @can('update',$lupaction)
                        <a href="#" class="btn btn-sm btn-primary text-white edit" data-bs-toggle="modal" data-bs-target="#modaleditaction{{ $lupaction->id }}" title="Edit Action Plan"><i class="ri-edit-2-fill"></i></a>                                                                       
                        <a href="/lup/action/{{Crypt::encryptString($lupaction->id)}}/delete" onclick="return confirm('Are you sure want to delete this action ?');" class="btn btn-danger text-white btn-sm" title="Delete Action Plan"><i class=" ri-delete-bin-5-fill"></i></a>                             
                      @endcan
                      @can('sign',$lupaction)
                        <a href="/lup/action/{{Crypt::encryptString($lupaction->id)}}/sign" onclick="return confirm('Are you sure want to sign this lup ?');" class="btn btn-success text-white btn-sm" title="Sign Action Plan"><i class="bi-check-lg"></i></a>                                                
                      @elsecan('cancelsign',$lupaction)
                        <a href="/lup/action/{{Crypt::encryptString($lupaction->id)}}/cancelsign" onclick="return confirm('Are you sure want to cancel sign this lup ?');" class="btn btn-info btn-sm" title="Cancel Sign Action Plan"><i class="bi-person-x"></i></a> 
                      @endcan   
                      @can('upload',$lupaction)
                        <a href="#" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modaluploadevidence{{ $lupaction->id}}" title="Upload Closing Evidence"><i class="bi-upload"></i></a>                                                
                      @endcan
                      <a href="/lup/action/{{ Crypt::encryptString($lupaction->id) }}/downloadevidence" class="btn btn-sm btn-success text-white" title="Download Closing Evidence" 
                        {{ $lupaction->evidence_filename ? '' : 'hidden'}}><i class=" bi-download"></i>
                      </a>
                      @can('approvedevidence',$lupaction)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedwithevidence{{ $lupaction->id }}" class="btn btn-sm btn-success text-white" title="Approved Closing Evidence" {{!$lupaction->evidence_filename ? 'hidden' : ''}}><i class="bi-file-earmark-check"></i></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedevidence{{ $lupaction->id }}" class="btn btn-sm btn-success text-white" title="Approved Closing Evidence" {{$lupaction->evidence_filename ? 'hidden' : ''}}><i class="bi-file-earmark-check"></i></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalrejectevidence{{ $lupaction->id }}" class="btn btn-sm btn-warning" title="Reject Closing Evidence" {{!$lupaction->evidence_filename ? 'hidden' : ''}}><i class="bi-file-earmark-x"></i></a>
                      @endcan        
                      @can('extended',$lupaction)              
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalextension{{ $lupaction->id }}" class="btn btn-sm btn-info" title="Submit Due Date Extension"><i class="bi-calendar-plus"></i></a>
                      @endcan
                      @can('reviewextended',$lupaction)       
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalreviewextension{{ $lupaction->id }}" class="btn btn-sm btn-secondary text-white" title="Review Due Date Extension"><i class="bi-calendar-week"></i></a>
                      @endcan
                      @can('approvedextended',$lupaction)   
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedextension{{ $lupaction->id }}" class="btn btn-sm btn-success text-white" title="Approved Due Date Extension"><i class="bi-calendar-check"></i></a>
                      @endcan
                      @can('rejectextended',$lupaction)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalrejectextension{{ $lupaction->id }}" class="btn btn-sm btn-danger text-white" title="Reject Due Date Extension"><i class="bi-calendar-minus"></i></a>              
                      @endcan
                      @can('requestcancelaction',$lupaction)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalrequestcancelaction{{ $lupaction->id }}" class="btn btn-sm btn-danger text-white" title="Request Cancel Action"><i class="bi-bookmark-x"></i></a>                                       
                      @endcan
                      @can('approvedcancelaction',$lupaction)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalapprovedcancelaction{{ $lupaction->id }}" class="btn btn-sm btn-success text-white" title="Approved Cancel Action"><i class="bi-bookmark-check"></i></a>                            
                      @endcan  
                    </th>
                      <td>{{$lupaction->action}}</td>         
                      <td>{{ $lupaction->pic_action }}</td>                    
                      <td>@date($lupaction->signdate_action,'d-M-y')</td>
                      <td>@date($lupaction->duedate_action,'d-M-y')</td>
                      <td class="{{$lupaction->statusaction=='OVERDUE' ? "bg-danger text-white" : 
                      ($lupaction->statusaction=='CLOSED' ? "bg-success text-white" : 
                      ($lupaction->statusaction=='ON EXTENSION' ? "bg-primary text-white" :
                      ""))
                    }}">{{ $lupaction->statusaction }}</td>  
                    <td>{{$lupaction->sign_type}}</td>                                    
                    <td>{{(!$lupaction->pic_action || !$lupaction->pic->department) ? '' : $lupaction->pic->department}}</td>                                          
                  </tr> 
                  @include('lup.modal.edit.actionplan')  
                  @empty             
                  @endforelse
                  </tbody>
            </table>       
          </div>        
      </div>
@include('lup.review.multievidence')    
      <div class="row">     
        <div class="col-md-12 mb-2">
          <div class="form-control">
            <label for="action_notes">Justification</label>
            <input type="text" class="form-control text-small" name="action_notes" id="action_notes" placeholder="Fill this ...If No action plan needed" value = "{{ old('action_notes',$lupparent->action_notes) }}" autocomplete="off" {{$lupparent->lupstatus=='APPROVED' ? '':'disabled'}}>          
            @error('action_notes')
              <div class="text-danger">{{ $message }}</div>
            @enderror 
          </div>
        </div>      
      </div>    
      <div class="select2-drpdwn">
        <div class="mb-5">
          <label class="col-form-label" for="lup_type">Proposed Change Notify To</label>                      
              <select class="js-example-placeholder-multiple col-sm-12" id="action_notifier" name="action_notifier[]" multiple="multiple" style="width: 175%">                
                      @foreach ($listusers as $listuser)
                        <option value="{{$listuser->email}} "
                          @foreach ($lupnotifier as $notifier)
                            {{($listuser->email==$notifier) ? 'selected' : ''}}
                          @endforeach
                          >{{$listuser->name}}
                        </option>                                                  
                      @endforeach   
              </select>                                                                                          
        </div>     
      </div>             
      
  </div>           <!-- End Action Plan Form --> 




                     
                              
                      
                      
                                                              
                                              
                        
                        
                         
                    