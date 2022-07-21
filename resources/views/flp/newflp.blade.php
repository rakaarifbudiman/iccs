@extends('layouts.admin.master')

@section('title', 'New FLP')

@section('content')


<div class="pagetitle">
  @component('components.breadcrumb')
    @slot('breadcrumb_title')
      <h3>New FLP</h3>
    @endslot            
          <li class="breadcrumb-item"><a href="/flp/masterlist">Master List FLP</a></li>
    @slot('bookmark')      
      <li><a href="#" data-container="body" data-bs-toggle="popover" data-placement="top" title="Save" data-original-title="Save" 
        onclick="event.preventDefault(); document.getElementById('submit-newflp').submit();"><i data-feather="save"></i></a></li>   
        <li><a href="#" data-container="body" data-bs-toggle="popover" data-placement="top" title="Clear Form" data-original-title="Clear Form" 
          onclick="event.preventDefault(); document.getElementById('submit-newflp').reset();"><i data-feather="delete"></i></a></li>         
    @endslot
  @endcomponent 
  
  <section class="section profile">
    <div class="row">      
        <div class="col-sm">
  
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">  
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#details">Details Product</button>
              </li> 
              
            </ul>            
            <div class="tab-content pt-2">
                  <div class="tab-pane fade show active details pt-3" id="details">  <!-- Details Form -->                
                    <form class="row g-3" method="POST" action="/flp/store" id="submit-newflp">
                      @csrf
                      @method('put')
                      <div class="col-md-12">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="documentname" id="documentname" placeholder="Product Name" required autofocus autocomplete="off" value="{{old('documentname')}}">
                          <label for="documentname">Product Name</label>
                          @error('documentname')
                                      <div class="text-danger">{{ $message }}</div>
                          @enderror 
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Active Ingredients" name="ingredients" id="ingredients" style="height: 100px;" required autocomplete="off">{{old('ingredients')}}</textarea>
                          <label for="ingredients">Active Ingredients</label>
                          @error('ingredients')
                                      <div class="text-danger">{{ $message }}</div>
                          @enderror 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="dosageform" id="dosageform" placeholder="Dosage Forms" required autocomplete="off" value="{{old('dosageform')}}">
                          <label for="dosageform">Dosage Forms</label>
                          @error('dosageform')
                                      <div class="text-danger">{{ $message }}</div>
                          @enderror 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="packaging" id="packaging" placeholder="Packaging" required autocomplete="off" value="{{old('packaging')}}">
                          <label for="packaging">Packaging</label>
                          @error('packaging')
                                      <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="regno" id="regno" placeholder="Registration No." required autocomplete="off" value="{{old('regno')}}">
                            <label for="regno">Registration No.</label>
                            @error('regno')
                                      <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating mb-3">
                          <select class="form-select" name="bussinessunit" id="bussinessunit" aria-label="Bussiness Unit" required autocomplete="off">
                            <option value="">Select Bussiness Unit</option>
                            @include('flp.new.listbussinessunit')
                          </select>
                          <label for="bussinessunit">Bussiness Unit</label>
                          @error('bussinessunit')
                                      <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="het" id="het" placeholder="het" required autocomplete="off" value="{{old('het')}}"> 
                          <label for="het">HET</label>
                          @error('het')
                                      <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">                  
                          <div class="form-floating">
                            <input type="date" class="form-control" name="duedate_start" id="duedate_start" placeholder="Launch Date" required autocomplete="off" value="{{old('duedate_start')}}">
                            <label for="duedate_start">Launch Date</label>
                            @error('duedate_start')
                                      <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>                 
                      </div>                
                      <div class="col-12">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Notes" name="notes" id="notes" style="height: 100px;">{{old('notes')}}</textarea>
                          <label for="notes">Notes</label>
                          @error('notes')
                                      <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>             
                                    
                      <div class="text-center">                        
                        
                      </div>
                    </form>         
                  </div>           <!-- End Details Form -->    


            </div>

               
  
              
  
            </div><!-- End Bordered Tabs -->
  
          </div>
        </div>
  
      </div>
    </div>
  </section>
</div><!-- End Page Title -->


@stop
