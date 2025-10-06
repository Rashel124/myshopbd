<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmOrderRequest;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Policy;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category::orderBy('name', 'asc')->with('subCategory')->get();
        $banners = Banner::get();
        $hotproducts = Product::where('product_type', 'hot')->orderby('id', 'desc')->paginate(20);
        $newproducts = Product::where('product_type', 'new')->orderby('id', 'desc')->paginate(20);
        $regularproducts = Product::where('product_type', 'regular')->orderby('id', 'desc')->paginate(20);
        $discountproducts = Product::where('product_type', 'discount')->orderby('id', 'desc')->paginate(20);
        return view('frontend.index', compact('hotproducts', 'newproducts', 'regularproducts', 'discountproducts', 'categories', 'banners'));
    }

    public function categoryProducts($slug, $id)
    {
        $category = Category::find($id);
        $products = Product::where('cat_id', $id)->get();
        $productscount = Product::where('cat_id', $id)->count();
        return view('frontend.category-products', compact('products', 'productscount', 'category'));
    }

    public function subCategoryProducts($slug, $id)
    {
        $subCategory = SubCategory::find($id);
        $products = Product::where('sub_cat_id', $id)->get();
        $productscount = Product::where('sub_cat_id', $id)->count();
        return view('frontend.subcategory-products', compact('subCategory', 'products', 'productscount'));
    }

    public function shop(Request $request)
    {
        if(isset($request->cat_id)){
            $products = Product::orderBy('id', 'desc')->where('cat_id', $request->cat_id)->paginate(20);
        }
        elseif(isset($request->sub_cat_id)){
            $products = Product::orderBy('id', 'desc')->where('sub_cat_id', $request->sub_cat_id)->paginate(20);
        }
        else{
            $products = Product::orderBy('id', 'desc')->paginate(20);
        }
        $productscount = $products->count();
        return view('frontend.shop', compact('products', 'productscount'));
    }

    public function return(){
         $returnPolicy = Policy::select('return_policy')->first();
        return view('frontend.return-process', compact('returnPolicy'));
    }

    public function productdetails($slug){

        $product = Product::where('slug', $slug)->with('color', 'size', 'galleryImage')->first();
        $categories = Category::orderby('name', 'asc')->get();
        return view('frontend.details', compact('product', 'categories'));
    }

    public function addToCartDetails(Request $request, $product_id)
    {
        $cartProduct = Cart::where('product_id', $product_id)->where('ip_address', $request->ip())->first();
        $product = Product::find($product_id);

        if($cartProduct == Null){
            $cart = new Cart();

            $cart->ip_address = $request->ip();
            $cart->product_id = $product->id;
            $cart->qty = $request->qty;
            $cart->color = $request->color;
            $cart->size = $request->size;

            if($product->discount_price == Null){
                $cart->price = $product->regular_price;
            }
            if($product->discount_price != Null){
                $cart->price = $product->discount_price;
            }

            $cart->save();

            if($request->action == "addToCart"){
                
                return redirect()->back();
            }
            if($request->action == "buyNow"){
                return redirect('/checkout');
            }
        }

        elseif($cartProduct != Null){
            $cartProduct->qty = $request->qty + $cartProduct->qty;
            $cartProduct->color = $request->color;
            $cartProduct->size = $request->size;

            if($product->discount_price == Null){
                $cartProduct->price = $product->regular_price;
            }
            if($product->discount_price != Null){
                $cartProduct->price = $product->discount_price;
            }

            $cartProduct->save();
             if($request->action == "addToCart"){
                toastr()->success('Your Product Added Successfully.');
                return redirect()->back();
            }
            if($request->action == "buyNow"){
                return redirect('/checkout');
            }
        }
    }

    public function addToCart(Request $request, $product_id)
    {
        $cartProduct = Cart::where('product_id', $product_id)->where('ip_address', $request->ip())->first();
        $product = Product::find($product_id);

          if($cartProduct == Null){
            $cart = new Cart();

            $cart->ip_address = $request->ip();
            $cart->product_id = $product->id;
            $cart->qty = 1;

            if($product->discount_price == Null){
                $cart->price = $product->regular_price;
            }
            if($product->discount_price != Null){
                $cart->price = $product->discount_price;
            }

            $cart->save();
             toastr()->success('Your Product Added Successfully.');
            return redirect()->back();
        }

          elseif($cartProduct != Null){
            $cartProduct->qty = 1 + $cartProduct->qty;

            if($product->discount_price == Null){
                $cartProduct->price = $product->regular_price;
            }
            if($product->discount_price != Null){
                $cartProduct->price = $product->discount_price;
            }

            $cartProduct->save();
             toastr()->success('Your Product Added Successfully.');
            return redirect()->back();
        }
    }
    public function deleteCartItem(Request $request, $id)
    {
        $cartItem = Cart::where('id', $id)->where('ip_address', request()->ip())->first();

        $cartItem->delete();
        toastr()->success('Your Product Delete Successfully.');
        return redirect()->back();
    }
    public function typeproducts($type){
        $products = Product::where('product_type', $type)->get();
        $productscount = Product::where('product_type', $type)->count();
        return view('frontend.typeproducts', compact('type', 'products', 'productscount'));
    }
    public function viewcart(){
        $cartitem = Cart::where('ip_address', request()->ip())->get();
        return view('frontend.view-products', compact('cartitem'));
    }
    public function checkout(){
        return view('frontend.checkout');
    }
    //Order Function..
    public function confirmOrder(ConfirmOrderRequest $request)
    {
        $order = new Order();

        $order->ip_address = $request->ip();
        $previousOrder = Order::orderBy('id', 'desc')->first();

       if($previousOrder == null){
            $generateInvoice = "BM-1";
        $order->invoice_number = $generateInvoice;
            }
    else{
        $generateInvoice = "BM-".($previousOrder->id+1);
        $order->invoice_number = $generateInvoice;
        }
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->charge = $request->charge;
        $order->price = $request->inputGrandTotal;

        $cartProducts = Cart::where('ip_address', $request->ip())->get();
        if($cartProducts->isNotEmpty()){
            $order->save();

            foreach($cartProducts as $cart){
                $orderDetails = new OrderDetails();

                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cart->product_id;
                $orderDetails->color = $cart->color;
                $orderDetails->size = $cart->size;
                $orderDetails->qty = $cart->qty;
                $orderDetails->price = $cart->price;

                $orderDetails->save();
                $cart->delete();
            }

            return redirect('success-order/'.$generateInvoice);
        }
        else{
            return redirect('/');
        }
    }

    public function successOrder($invoiceid)
    {
        return view('frontend.thankyou', compact('invoiceid'));
    }
    // Policy
    public function privacy()
    {
        $privacyPolicy = Policy::select('privacy_policy')->first();
        return view('frontend.privacy-policy', compact('privacyPolicy'));
    }

    public function terms()
    {
        $termsConndition = Policy::select('terms_conditions')->first();
        return view('frontend.terms-Conditions', compact('termsConndition'));
    }

    public function refundPolicy()
    {
        $refundpolicy = Policy::select('refund_policy')->first();
        return view('frontend.refund-Policy', compact('refundpolicy'));
    }

    public function paymentPolicy()
    {
        $paymentPolicy = Policy::select('payment_policy')->first();
        return view('frontend.payment-Policy', compact('paymentPolicy'));
    }

    public function aboutUs()
    {
        $aboutus = Policy::select('about_us')->first();
        return view('frontend.about-us', compact('aboutus'));
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function contactUsStore(Request $request)
    {
        $contactMessage = new ContactUs();

        $contactMessage->name = $request->name;
        $contactMessage->phone = $request->phone;
        $contactMessage->email = $request->email;
        $contactMessage->message = $request->message;

        $contactMessage->save();
        toastr()->success('Message Sent Successfully!');
        return redirect()->back();
    }
    public function searchProduct(Request $request)
    {
        $searchParam = $request->search;
        $products = Product::where('name', 'LIKE', '%'.$searchParam.'%')->get();
        $productCount = $products->count();
        return view('frontend.search-products', compact('products', 'searchParam', 'productCount'));
    }
}
