@extends('backend.master')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Order Details</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
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
                <form action="{{url('/admin/order/update/'.$order->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <!--begin::Quick Example-->
                        <div class="card card-primary card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header">
                                <div class="card-title">Customer Info</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputEmail1" class="form-label">Invoice No*</label>
                                        <input type="text" class="form-control" value="{{$order->invoice_number}}" id="invoice_number"
                                            name="invoice_number" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleInputEmail1" class="form-label">Customer Name*</label>
                                        <input type="text" class="form-control" value="{{$order->name}}" id="name"
                                            name="name" required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleInputEmail1" class="form-label">Customer Phone*</label>
                                        <input type="text" class="form-control" value="{{$order->phone}}" id="phone"
                                            name="phone" required />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputEmail1" class="form-label">Delivery Charge*</label>
                                        <input type="text" class="form-control" value="{{$order->charge}}" id="charge"
                                            name="charge" required />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputEmail1" class="form-label">Customer Address*</label>
                                        <textarea class="form-control" name="address" id="address" required>{{$order->address}}</textarea>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleInputEmail1" class="form-label">Courier*</label>
                                        <select name="courier_name" class="form-control">
                                            <option value="">Select Courier</option>
                                            <option value="Steadfast" @if ($order->courier_name == "Steadfast")
                                                Selected
                                            @endif>Steadfast</option>
                                            <option value="Pathao" @if ($order->courier_name == "Pathao")
                                                Selected
                                            @endif>Pathao</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--end::Form-->
                        </div>
                        <!--end::Quick Example-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Quick Example-->
                        <div class="card card-primary card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header">
                                <div class="card-title">Product Info</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <!--begin::Body-->
                            <div class="card-body">
                               @foreach ($order->Orderdetails as $details)
                                        <div class="md-5" id="subform" data-id="{{$details->id}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{asset('backend/images/product/'.$details->product->image)}}" height="100" width="100"><br>
                                            {{$details->product->name}}
                                        </div>
                                        <div class="col-md-8">
                                            <label>Unit Price:</label><input type="number" class="form-control" name="" value="{{$details->price}}" readonly>
                                            <label>Quantity:</label><input type="number" class="form-control" name="qty" value="{{$details->qty}}" required>
                                            <label>Color:</label><input type="text" class="form-control" name="color" value="{{$details->color}}">
                                            <label>Size:</label><input type="text" class="form-control" name="size" value="{{$details->size}}">
                                            <input type="button" onclick="submitForm({{$details->id}})" value="Update" class="form-control mt-3 btn btn-success">
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                                 <label>Total Price:</label><input type="number" class="form-control" name="price" value="{{$order->price}}" required>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Order</button>
                            </div>
                            <!--end::Footer-->
                            <!--end::Form-->
                        </div>
                        <!--end::Quick Example-->
                    </div>
                </form>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
@push('script')
    <script>
        function submitForm(id){
            subform = document.querySelector('#subform[data-id="'+id+'"]');

            formData = new FormData();

            formData.append('_token', '{{ csrf_token() }}');
            formData.append('qty', subform.querySelector('[name="qty"]').value);
            formData.append('color', subform.querySelector('[name="color"]').value);
            formData.append('size', subform.querySelector('[name="size"]').value);

            fetch('/admin/order-details/update/'+id,{
                method: 'POST',
                body: formData
            }).then(res => res.json()).then(data => {
                alert("Updated Successfully");
            })
        }
    </script>
@endpush