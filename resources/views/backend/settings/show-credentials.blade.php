@extends('backend.master')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Update Credentians</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Credentians</li>
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
            <div class="row g-4">
                <!--begin::Col-->
                <div class="col-md-12">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Form-->
                        <form action="{{url('/admin/update-credentials')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">User Name*</label>
                                    <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name" />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control" id="email" value="{{$user->email}}" name="email" required />
                                </div>
                                <div class="mb-3">
                                    <label for="old_password" class="form-label">Old Password*</label>
                                    <input type="password" class="form-control" id="old_password" value="" name="old_password" />
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password*</label>
                                    <input type="password" class="form-control" id="password" value="" name="password" />
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Comfirm New Password*</label>
                                    <input type="password" class="form-control" id="confirm_password" value="" name="confirm_password" />
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
