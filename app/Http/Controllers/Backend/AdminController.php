<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function adminDashboard()
    {
        $allOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $confirmedOrders = Order::where('status', 'confirmed')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $returnedOrders = Order::where('status', 'returned')->count();
        return view('backend.admin-dashboard', compact('allOrders', 'pendingOrders', 'confirmedOrders', 'deliveredOrders','cancelledOrders', 'returnedOrders'));
    }
}
