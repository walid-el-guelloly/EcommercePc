<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items']);
        $statuses = ['pending', 'confirmed', 'paid', 'shipped', 'completed', 'cancelled'];

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,confirmed,paid,shipped,completed,cancelled',
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('success', 'Statut de la commande mis à jour.');
    }
}