@extends('backend.master')
@section('content')
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Category List</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{url('/admin/dashboard/')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Category List</li>
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
                    <h3 class="card-title">Manage Categories</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>image</th>
                          <th>Category Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       @forelse ($categories as $category)
                          <tr class="align-middle">
                          <td>{{$loop->index+1}}</td>
                          <td>
                            <img src="{{asset('backend/images/category/'.$category->image)}}" height="100" width="100">
                          </td>
                          <td>{{$category->name}}</td>
                          <td>
                            <a href="{{url('/admin/category/edit/'.$category->id)}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                             <a href="{{url('/admin/category/delete/'.$category->id)}}" onclick="return confirm('Are you sure delete category list?')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                          </td>
                        </tr>
                       @empty
                         
                       @endforelse
                      </tbody>
                    </table>
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