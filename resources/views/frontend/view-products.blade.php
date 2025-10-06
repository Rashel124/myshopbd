@extends('frontend.master')
@section('content')
<section class="cart-products-section">
            <div class="container">
                <a href="{{url('/')}}" class="continue-shopping-btn">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    Continue Shopping
                </a>
                <div class="cart-products-wrapper">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>Product Name</th>
                                <th>price</th>
                                <th>quantity</th>
                                <th>remove</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>       
                           @foreach ($cartitem as $item)
                            @php
                                $subTotal = $item->price * $item->qty;
                            @endphp
                            <tr>
                                <td class="cart-product-image-outer">
                                    <img src={{asset('backend/images/product/'.$item->product->image)}} height="90" width="90">
                                </td>
                                <td class="cart-product-name-outer">
                                    {{$item->product->name}}
                                </td>
                                <td class="cart-product-price-outer">
                                    ৳ {{$item->price}}
                                </td>
                                <td class="qty-increment-decrement-outer">
                                    <input type="number" name="qty" readonly value="{{$item->qty}}" min="1" />
                                </td>
                                <td>
                                    <a href="{{url('/cart/delete/'.$item->id)}}" class="remove-product">Remove</a>
                                </td>
                                <td class="cart-product-total-outer">
                                    ৳ {{$subTotal}}
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="{{'/checkout'}}" class="process-checkout-btn">
                        Proceed To CheckOut
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </section>
@endsection