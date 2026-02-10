<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalogue complet
Route::get('/catalogue', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Panier (déjà fait)
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/supprimer/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');