<div class="tab-pane fade categorization pt-0" id="categorization"> <!-- categorization Form -->    
        <label class="col-sm-2 col-form-label"></label>            
                <div class="row">
                    <div class="col-sm-8"> <!-- Left Side --> 
                        <div class="row mb-3">        
                            <div class="col-sm-6"> 
                                <label class="form-check-label mb-2 
                                    {{ $lupparent->categorization=='Critical' ? 'text-purple' : ($lupparent->categorization=='Major' ? 'text-danger' : 'text-dark') }}" 
                                    id="label_categorization" name="label_categorization">Change Categorization : {{ $lupparent->categorization }}                                    
                                </label>
                                <input type="text" name="categorization" id="categorization" value="{{ $lupparent->categorization }}" hidden> 
                                <div class="form-check form-switch">              
                                    <input class="form-check-input" type="checkbox" value="1" name="product_impact"  id="product_impact" {{ $lupparent->product_impact==1 ? ' checked' : ''}}>                        
                                    <label class="form-check-label" for="product_impact">Product/material quality impact : {{ $lupparent->product_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-check form-switch">            
                                    <input class="form-check-input" type="checkbox" value="1" name="facilities_impact" id="facilities_impact" {{ $lupparent->facilities_impact==1 ? ' checked' : '' }}>                     
                                    <label class="form-check-label" for="facilities_impact">Facilities Impact : {{ $lupparent->facilities_impact==1 ? 'Yes' : 'No'}} </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="equipment_impact" id="equipment_impact" {{ $lupparent->equipment_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="equipment_impact">Equipment/utilities impact : {{ $lupparent->equipment_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="productcontact_impact" id="productcontact_impact" {{ $lupparent->productcontact_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="productcontact_impact">Product contact equip impact : {{ $lupparent->productcontact_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="decomission_impact" id="decomission_impact" {{ $lupparent->decomission_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="decomission_impact">Decomission equip : {{ $lupparent->decomission_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="maintenance_impact" id="maintenance_impact" {{ $lupparent->maintenance_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="maintenance_impact">Calibration/maintenance impact : {{ $lupparent->maintenance_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="compliance_impact" id="compliance_impact" {{ $lupparent->compliance_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="compliance_impact">GXP/compliance impact : {{ $lupparent->compliance_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="regulatory_impact" id="regulatory_impact" {{ $lupparent->regulatory_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="regulatory_impact">Regulatory impact : {{ $lupparent->regulatory_impact==1 ? 'Yes' : 'No'}} </label>
                                </div>      
                            </div>                                      
                            <div class="col-sm-6"> {{-- left side - change categorization 2 --}}
                                <label class="form-check-label mb-2" id="label_categorization" name="label_categorization"></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="patient_impact" id="patient_impact" {{ $lupparent->patient_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="patient_impact">Patient safety impact : {{ $lupparent->patient_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="integrity_impact" id="integrity_impact" {{ $lupparent->integrity_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="integrity_impact">Data integrity impact : {{ $lupparent->integrity_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>   
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="environment_impact" id="environment_impact" {{ $lupparent->environment_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="environment_impact">Environment impact : {{ $lupparent->environment_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>    
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="health_impact" id="health_impact" {{ $lupparent->health_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="health_impact">Health & safety impact  : {{ $lupparent->health_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>   
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="computer_impact" id="computer_impact" {{ $lupparent->computer_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="computer_impact">Computer system impact : {{ $lupparent->computer_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>   
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="supply_impact" id="supply_impact" {{ $lupparent->supply_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="supply_impact">Product/material supply impact : {{ $lupparent->supply_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>   
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="validation_impact" id="validation_impact" {{ $lupparent->validation_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="validation_impact">Validation/qual impact : {{ $lupparent->validation_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>   
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" value="1" value="1" name="stability_impact" id="stability_impact" {{ $lupparent->stability_impact==1 ? ' checked' : ''  }}>
                                    <label class="form-check-label" for="stability_impact">Product stability impact : {{ $lupparent->stability_impact==1 ? 'Yes' : 'No'}}</label>
                                </div>                         
                            </div>                      
                            
                        </div>       
                        <div class="row mb-3"> 
                            <div class="col-sm-12">                         
                                <label class="form-check-label mb-2" id="categorization" name="categorization">Risk Assestment :</label>               
                                <div class="form-floating">
                                    <label for="risk_assestment">Risk Assestment</label>
                                    <textarea  name="risk_assestment" id="risk_assestment" required minlength="10" autocomplete="off">
                                        {{ old('risk_assestment',$lupparent->risk_assestment) }}
                                    </textarea>
                                    @error('risk_assestment')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror                           
                                
                                </div>
                            </div>
                        </div>
                    </div><!-- End Left Side --> 
                    <div class="col-sm-4"> <!-- Right Side --> 
                        <div class="row mb-3"> 
                            <div class="col-sm-12">                         
                                <label class="form-check-label mb-2" id="categorization" name="categorization">Regulatory Impact : </label>               
                                <div class="form-floating input-sm">                                    
                                    <select class="form-select" placeholder="Select this..." name="regulatory_change_type" id="regulatory_change_type" aria-label="Change Type" required autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                        <option value="{{ $lupparent->regulatory_change_type }}">{{ $lupparent->regulatory_change_type==null ? 'Select Regulatory Change Type...' : old('regulatory_change_type',$lupparent->regulatory_change_type) }}</option>
                                        <option value="Can be implemented immediately">Can be implemented immediately</option>
                                        <option value="Waiting approval of regulatory body">Waiting approval of regulatory body</option>    
                                        <option value="Have been approved by regulatory body">Have been approved by regulatory body</option>                              
                                    </select>    
                                    <label for="regulatory_change_type">Regulatory Change Type</label>
                                    @error('regulatory_change_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror                        
                                
                                </div>
                            </div>
                            <div class="col-sm-12">                                                          
                                <div class="form-floating input-sm">                                    
                                    <select class="form-select" placeholder="Select this..." name="regulatory_variation" id="regulatory_variation" aria-label="Change Type" required autocomplete="off" {{Auth::user()->can('update',$lupparent) ? '':'disabled'}}>
                                        <option value="{{ $lupparent->regulatory_variation }}">{{ $lupparent->regulatory_variation==null ? 'Select Regulatory Variation...' : old('regulatory_variation',$lupparent->regulatory_variation) }}</option>
                                        <option value="Minor">Minor</option>
                                        <option value="Major">Major</option>  
                                        <option value="Notification">Notification</option>                               
                                    </select>    
                                    <label for="regulatory_variation">Regulatory Variation</label>
                                    @error('regulatory_variation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror                       
                                
                                </div>
                            </div>                            
                        </div>
                    </div> <!-- End Right Side -->             
                </div>
</div>

            

