<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AccountController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalogue complet et détail (on les garde)
Route::get('/catalogue', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Panier (inchangé)
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/supprimer/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

// Contact : seulement le POST (le formulaire sera dans la home)
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Tu peux supprimer/commenter :
Route::view('/a-propos', 'pages.about')->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

    Route::middleware('auth')->group(function () {
    Route::get('/compte', [AccountController::class, 'index'])->name('account.index');
    Route::post('/compte', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
    Route::post('/compte/mot-de-passe', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
});