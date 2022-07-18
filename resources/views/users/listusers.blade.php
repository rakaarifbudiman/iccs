@extends('layouts_old.main')

@section('title', 'List User ICCS')

@section('content')
<div class="pagetitle">
  <h1>List User ICCS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active">List User ICCS</li>
    </ol>
  </nav>
  <section class="section dashboard">
  <div class="row">
    <div class="table-responsive text-nowrap">

      <!-- <div class="card">
        <div class="card-body"> -->

        <table class="table datatable small">
        <thead>    
            <tr>
                <th scope="col"> No. </th>
                <th scope="col">Operation</th>
                <th scope="col">Username</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Leader</th>
                <th scope="col">Level</th>
                <th scope="col">Grade</th>
                <th scope="col">Department</th>
                <th scope="col">Notes</th>
                <th scope="col">Active ?</th>
                
            </tr>
          </thead>
          <tbody>

            @foreach ($user as $index =>$u)            
            
            <tr>
                <th scope="row">{{ $index +1 }}</th>
                <td>
                  @php
                    $id= Crypt::encryptString($u->id);
                  @endphp
                    <a href="/users-profile/{{$id}}/edit" class="btn btn-primary btn-sm" title="Edit User"><i class=" ri-edit-2-fill"></i></a>
                    <a href="/users-profile/delete/{{$id}}" onclick="return confirm('Are you sure want to delete this user ?');" class="btn btn-danger btn-sm" title="Hapus User"><i class=" ri-delete-bin-5-fill"></i></a>
                </td>
                <td>{{ $u->username }}</td>
                <td >{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->leader}}</td>
                <td>{{ $u->level }}</td>
                <td>{{ $u->grade }}</td>
                <td>{{ $u->department }}</td>
                <td>{{ $u->notes }}</td>
                <td>{{ $u->active }}</td>
                
                

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

