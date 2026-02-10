<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $cart = session()->get('cart', []);

        // Calcul du total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    // Ajouter un produit au panier
    public function add(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);

        $quantityToAdd = (int) $request->input('quantity', 1);
        if ($quantityToAdd < 1) {
            $quantityToAdd = 1;
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantityToAdd;
        } else {
            $cart[$product->id] = [
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => $quantityToAdd,
                'image_path' => $product->image_path,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    // Retirer complètement un produit du panier
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
    }

    // Vider le panier
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Panier vidé.');
    }
}