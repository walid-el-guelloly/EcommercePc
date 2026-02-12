<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Afficher la page de checkout (récapitulatif)
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

        return view('checkout.show', compact('cart', 'total'));
    }

    // Traiter la commande
    public function process(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->withErrors(['checkout' => 'Votre panier est vide.']);
        }

        try {
            $order = DB::transaction(function () use ($user, $cart) {
                $productIds = array_keys($cart);

                // On récupère les produits depuis la base
                $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

                $total = 0;
                $itemsData = [];

                foreach ($cart as $productId => $item) {
                    if (! isset($products[$productId])) {
                        throw new \Exception("Produit introuvable.");
                    }

                    $product = $products[$productId];
                    $quantity = $item['quantity'];

                    // Vérifier le stock
                    if ($product->stock < $quantity) {
                        throw new \Exception("Stock insuffisant pour le produit : {$product->name}");
                    }

                    $linePrice = $product->price;               // on prend le prix depuis la base
                    $lineTotal = $linePrice * $quantity;
                    $total += $lineTotal;

                    $itemsData[] = [
                        'product_id'   => $product->id,
                        'product_name' => $product->name,
                        'price'        => $linePrice,
                        'quantity'     => $quantity,
                    ];
                }

                // Créer la commande
                $order = Order::create([
                    'user_id' => $user->id,
                    'status'  => 'confirmed', // plus tard : pending/paid etc.
                    'total'   => $total,
                ]);

                // Créer les lignes de commande
                foreach ($itemsData as $data) {
                    $order->items()->create($data);
                }

                // Décrémenter le stock
                foreach ($cart as $productId => $item) {
                    $product = $products[$productId];
                    $product->decrement('stock', $item['quantity']);
                }

                return $order;
            });

        } catch (\Exception $e) {
            return back()->withErrors([
                'checkout' => 'Impossible de finaliser la commande : '.$e->getMessage(),
            ]);
        }

        // Vider le panier
        session()->forget('cart');

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Votre commande a bien été enregistrée.');
    }
}