<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // $orders = Order::with(['user', 'product'])->get();
        $orders = Order::where('user_id', auth()->id())->get();
        return view('order', compact('orders'));
    }
}
