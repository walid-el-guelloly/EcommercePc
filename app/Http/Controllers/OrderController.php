<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items');

        return view('orders.show', compact('order'));
    }
}