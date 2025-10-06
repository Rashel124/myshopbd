@extends('backend.master')
@section('content')
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Contact Message List</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="/admin/dashboard/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Contact Message List</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <!-- /.card -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Manage Contacts</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Message</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       @forelse ($messages as $message)
                          <tr class="align-middle">
                          <td>{{$loop->index+1}}</td>
                          <td>{{$message->name}}</td>
                          <td>{{$message->phone}}</td>
                          <td>{{$message->email}}</td>
                          <td>{{$message->message}}</td>
                          <td>
                            <a href="{{url('/admin/contact-message/delete/'.$message->id)}}" onclick="return confirm('Are you sure delete Contect list?')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                          </td>
                        </tr>
                       @empty 
                       @endforelse
                      </tbody>
                    </table>
                    {{$messages->links()}}
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection