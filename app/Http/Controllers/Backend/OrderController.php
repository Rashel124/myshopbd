<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showOrders(Request $request, $status)
    {
         if(isset($request->search) && $status == "all"){
            $orders = Order::with('OrderDetails')
            ->where('phone','LIKE',  '%'.$request->search.'%')
            ->orWhere('name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('invoice_number', 'LIKE', '%'.$request->search.'%')->paginate(20);
        }

        else if(isset($request->search)&& $status != "all"){
            $orders = Order::with('OrderDetails')
            ->where('status', $status)
            ->where('phone','LIKE',  '%'.$request->search.'%')
            ->orWhere('name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('invoice_number', 'LIKE', '%'.$request->search.'%')->paginate(20);
        }
        else{
           if($status == "all"){
             $orders = Order::with('OrderDetails')->paginate(20); 
           }
           else{
            $orders = Order::with('OrderDetails')->where('status', $status)->paginate(20);
           }  
        }
        return view('backend.order.show-orders', compact('orders','status'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        
        $order->save();
        return redirect()->back();
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $orderDetails = OrderDetails::where('order_id', $id)->get();
        foreach($orderDetails as $details){
            $details->delete();
        }
        $order->delete();
        toastr()->success('Order Delete Successfully');
        return redirect()->back();
    }

    public function editOrder($id)
    {
        $order = Order::with('Orderdetails')->where('id', $id)->first();
        return view('backend.order.edit-order', compact('order'));
    }

    public function updateOrder(Request $request,$id)
    {
        $order = Order::find($id);

        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->charge = $request->charge;
        $order->address = $request->address;
        $order->courier_name = $request->courier_name;
        $order->price = $request->price;

        $order->save();
        toastr()->success('Order Updated Successfully');
        return redirect()->back();
    }

    public function updateOrderDetails(Request $request, $id)
    {
        $details = OrderDetails::find($id);
       
        $details->qty = $request->qty;
        $details->color = $request->color;
        $details->size = $request->size;

        $details->save();
        return response()->json('Updated Successfully');
    }

    // Courier....
    public function courierEntry($order_id)
    {
        $order = Order::find($order_id);

       if($order->courier_name == "Steadfast"){
         $apiendpoint = "https://portal.packzy.com/api/v1/create_order";

        $header = [
            'Api-Key' => "jla9q5zsl2a3x70ab8q26swdk5bkb8gr",
            'Secret-Key' => "8aqo4qh0f7wuqfzeijfqsjyy",
            'Content-Type' => "application/json"
        ];

        // Body Perameters
        $invoicenumber = $order->invoice_number;
        $customername = $order->name;
        $customerphone = $order->phone;
        $customeraddress = $order->address;
        $amount = $order->price;

        $payload = [
            'invoice' => $invoicenumber,
            'recipient_name' => $customername,
            'recipient_phone' => $customerphone,
            'recipient_address' => $customeraddress,
            'cod_amount' => $amount,
        ];

        $response = Http::withHeaders($header)->post($apiendpoint, $payload);
        $jsondata = $response->json();
        // dd($jsondata);

        if(isset($jsondata['consignment'])){
            $order->traking_code = $jsondata['consignment']['tracking_code'];
            $order->consignment_id = $jsondata['consignment']['consignment_id'];

            $order->save();
        }
       }

       elseif($order->courier_name == "Pathao"){

       }

       toastr()->success("Courier Entry Successfull!");
        return redirect()->back();
    }

    // print Invoice
    public function printInvoice($order_id)
    {
        $order = Order::with('Orderdetails')->where('id', $order_id)->first();
        return view('backend.order.invoice',  compact('order'));
    }

    public function printBulkInvoice(Request $request)
    {
        $orderIds = $request->order_id;
        $orders = Order::with('Orderdetails')->whereIn('id', $orderIds)->get();

        return view('backend.order.bulk-invoice', compact('orders'));
    }
}
