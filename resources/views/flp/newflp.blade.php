@extends('layouts.main')

@section('title', 'New FLP')

@section('content')


<div class="pagetitle">
    <h1>Create New FLP</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">FLP</li>
        <li class="breadcrumb-item active">New</li>
      </ol>
    </nav>
  
  
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
                    <form class="row g-3" method="POST" action="/postflp">
                      @csrf
                      @method('put')
                      <div class="col-md-12">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="documentname" id="documentname" placeholder="Product Name" required autofocus autocomplete="off">
                          <label for="documentname">Product Name</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Active Ingredients" name="ingredients" id="ingredients" style="height: 100px;" required autocomplete="off"></textarea>
                          <label for="ingredients">Active Ingredients</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="dosageform" id="dosageform" placeholder="Dosage Forms" required autocomplete="off">
                          <label for="dosageform">Dosage Forms</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="packaging" id="packaging" placeholder="Packaging" required autocomplete="off">
                          <label for="packaging">Packaging</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="regno" id="regno" placeholder="Registration No." required autocomplete="off">
                            <label for="regno">Registration No.</label>
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
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="het" id="het" placeholder="het" required autocomplete="off">
                          <label for="het">HET</label>
                        </div>
                      </div>
                      <div class="col-md-4">                  
                          <div class="form-floating">
                            <input type="date" class="form-control" name="launch" id="launch" placeholder="Launch Date" required autocomplete="off">
                            <label for="launch">Launch Date</label>
                          </div>                 
                      </div>                
                      <div class="col-12">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Notes" name="notes" id="notes" style="height: 100px;"></textarea>
                          <label for="notes">Notes</label>
                        </div>
                      </div>             
                                    
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
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
