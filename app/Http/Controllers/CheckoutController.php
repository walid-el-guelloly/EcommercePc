<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    
    public function show()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')
            ->with('success', 'Votre panier est vide.');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $user = Auth::user();

    return view('checkout.show', compact('cart', 'total', 'user'));
}

public function process(Request $request)
{
    $user = Auth::user();
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')
            ->withErrors(['checkout' => 'Votre panier est vide.']);
    }

    
    $data = $request->validate([
        'shipping_name'          => 'required|string|max:255',
        'shipping_address'       => 'required|string|max:255',
        'shipping_city'          => 'required|string|max:255',
        'shipping_postal_code'   => 'nullable|string|max:50',
        'shipping_country'       => 'nullable|string|max:100',
        'shipping_phone'         => 'nullable|string|max:50',

        'billing_same_as_shipping' => 'nullable|boolean',

        'billing_name'          => 'nullable|string|max:255',
        'billing_address'       => 'nullable|string|max:255',
        'billing_city'          => 'nullable|string|max:255',
        'billing_postal_code'   => 'nullable|string|max:50',
        'billing_country'       => 'nullable|string|max:100',
        'billing_phone'         => 'nullable|string|max:50',
    ]);

    
    $billingSame = $request->boolean('billing_same_as_shipping', true);
    if ($billingSame) {
        $data['billing_name']        = $data['shipping_name'];
        $data['billing_address']     = $data['shipping_address'];
        $data['billing_city']        = $data['shipping_city'];
        $data['billing_postal_code'] = $data['shipping_postal_code'];
        $data['billing_country']     = $data['shipping_country'] ?? 'Maroc';
        $data['billing_phone']       = $data['shipping_phone'];
    }

    try {
        $order = DB::transaction(function () use ($user, $cart, $data) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

            $total = 0;
            $itemsData = [];

            foreach ($cart as $productId => $item) {
                if (! isset($products[$productId])) {
                    throw new \Exception("Produit introuvable.");
                }

                $product = $products[$productId];
                $quantity = $item['quantity'];

                if ($product->stock < $quantity) {
                    throw new \Exception("Stock insuffisant pour le produit : {$product->name}");
                }

                $linePrice = $product->price;
                $lineTotal = $linePrice * $quantity;
                $total += $lineTotal;

                $itemsData[] = [
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'price'        => $linePrice,
                    'quantity'     => $quantity,
                ];
            }

            
            $order = Order::create([
                'user_id'            => $user->id,
                'status'             => 'pending', 
                'total'              => $total,
                'shipping_name'      => $data['shipping_name'],
                'shipping_address'   => $data['shipping_address'],
                'shipping_city'      => $data['shipping_city'],
                'shipping_postal_code' => $data['shipping_postal_code'],
                'shipping_country'   => $data['shipping_country'] ?? 'Maroc',
                'shipping_phone'     => $data['shipping_phone'],

                'billing_name'       => $data['billing_name'] ?? null,
                'billing_address'    => $data['billing_address'] ?? null,
                'billing_city'       => $data['billing_city'] ?? null,
                'billing_postal_code'=> $data['billing_postal_code'] ?? null,
                'billing_country'    => $data['billing_country'] ?? null,
                'billing_phone'      => $data['billing_phone'] ?? null,
            ]);

            foreach ($itemsData as $itemData) {
                $order->items()->create($itemData);
            }

            foreach ($cart as $productId => $item) {
                $product = $products[$productId];
                $product->decrement('stock', $item['quantity']);
            }

            return $order;
        });

    } catch (\Exception $e) {
        return back()->withErrors([
            'checkout' => 'Impossible de finaliser la commande : '.$e->getMessage(),
        ])->withInput();
    }

    session()->forget('cart');

    return redirect()
        ->route('orders.show', $order)
        ->with('success', 'Votre commande a bien été enregistrée.');
}
}