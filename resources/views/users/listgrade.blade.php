@extends('layouts.admin.master')

@section('title', 'List Grade ICCS')

@section('content')
<div class="pagetitle">
  <h1>List Grade ICCS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active">List Grade ICCS</li>
    </ol>
  </nav>
  <section class="section dashboard">
  <div class="row">
    <div class="table-responsive text-nowrap">

      <!-- <div class="card">
        <div class="card-body"> -->

        <table class="table datatable w-auto">
        <thead>    
            <tr>
                <th scope="col"> No. </th>
                <th scope="col">Operation</th>
                <th scope="col">Grade</th>               
                
            </tr>
          </thead>
          <tbody>

            @foreach ($grades as $index =>$grade)            
            
            <tr>
                <th scope="row">{{ $index +1 }}</th>
                <td>
                  @php
                    $id= Crypt::encryptString($grade->id);
                  @endphp
                    <a href="/grade/{{$id}}/edit" class="btn btn-primary btn-sm" title="Edit grade"><i class=" ri-edit-2-fill"></i></a>
                    <a href="/grade/delete/{{$id}}" onclick="return confirm('Are you sure want to delete this grade ?');" class="btn btn-danger btn-sm" title="Delete grade"><i class=" ri-delete-bin-5-fill"></i></a>
                </td>
                <td>{{ $grade->grade }}</td>          
                
                

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

