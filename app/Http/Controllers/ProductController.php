<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    // Liste des produits (page d'accueil)
    public function index()
    {
        $products = Product::with('category')->paginate(12);

        return view('products.index', compact('products'));
    }

    // Détail d'un produit
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}