<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $featuredProducts = Product::inRandomOrder()->take(4)->get();
        $newProducts = Product::latest()->take(8)->get();

        return view('home', compact('categories', 'featuredProducts', 'newProducts'));
    }
}