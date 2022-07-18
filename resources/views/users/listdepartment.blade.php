@extends('layouts_old.main')

@section('title', 'List Department ICCS')

@section('content')
<div class="pagetitle">
  <h1>List Department ICCS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active">List Department ICCS</li>
    </ol>
  </nav>
  <section class="section dashboard">
  <div class="row">
    <div class="table-responsive text-nowrap">

      <!-- <div class="card">
        <div class="card-body"> -->

        <table class="table datatable w-auto" id="departmentTable">
        <thead>    
            <tr>
                <th scope="col"> No. </th>
                <th scope="col">Operation</th>
                <th scope="col">Department</th>               
                
            </tr>
          </thead>
          <tbody>

            @foreach ($departments as $index =>$department)            
            
            <tr>
                <th scope="row">{{ $index +1 }}</th>
                <td>
                  @php
                    $id= Crypt::encryptString($department->id);
                  @endphp
                  
                    <a href="/department/{{$id}}/edit" class="btn btn-sm btn-primary edit" title="Edit Department"><i class=" ri-edit-2-fill"></i></a>
                    <a href="/department/delete/" onclick="return confirm('Are you sure want to delete this department ?');" class="btn btn-danger btn-sm" title="Delete Department"><i class=" ri-delete-bin-5-fill"></i></a>
                </td>
                <td>{{ $department->department }}</td>          
                
                
                
            </tr>
            
            @endforeach
            </tbody>
          </table>


          

          <!-- </div> -->
      <!-- </div> -->

    </div>
  </div>

</section>

</div><!-- End Page Title -->
@stop

