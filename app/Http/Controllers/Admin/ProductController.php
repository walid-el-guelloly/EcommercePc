<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

      public function store(Request $request)
    {
                $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image_file'  => 'nullable|image|max:2048',
            'image_path'  => 'nullable|string|max:255', // URL optionnelle
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        }

        // Gestion de l'image
        $imagePath = $data['image_path'] ?? null;

        if ($request->hasFile('image_file')) {
            $storedPath = $request->file('image_file')->store('products', 'public');
            $imagePath = $storedPath; // on stocke le chemin relative (ex: products/xyz.jpg)
        }

        Product::create([
            'category_id' => $data['category_id'],
            'name'        => $data['name'],
            'slug'        => $data['slug'],
            'description' => $data['description'] ?? null,
            'price'       => $data['price'],
            'stock'       => $data['stock'],
            'image_path'  => $imagePath,
        ]);
    }

    


    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image_file'  => 'nullable|image|max:2048',
            'image_path'  => 'nullable|string|max:255',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = $product->slug ?: Str::slug($data['name']) . '-' . uniqid();
        }

        // On part de l'image actuelle
        $imagePath = $product->image_path;

        // Si une nouvelle URL est fournie (et pas de fichier), on remplace
        if (!empty($data['image_path']) && !$request->hasFile('image_file')) {
            $imagePath = $data['image_path'];
        }

        // Si un fichier est uploadé, il prend le dessus
        if ($request->hasFile('image_file')) {
            $storedPath = $request->file('image_file')->store('products', 'public');
            $imagePath = $storedPath;
        }

        $product->update([
            'category_id' => $data['category_id'],
            'name'        => $data['name'],
            'slug'        => $data['slug'],
            'description' => $data['description'] ?? null,
            'price'       => $data['price'],
            'stock'       => $data['stock'],
            'image_path'  => $imagePath,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produit supprimé.');
    }
}