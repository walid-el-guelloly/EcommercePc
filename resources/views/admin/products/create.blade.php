@extends('layouts.admin')

@section('header', 'Nouveau produit')

@section('content')
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-soft">
        <h2 class="text-base font-semibold mb-4">Créer un produit</h2>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @include('admin.products._form', ['product' => new \App\Models\Product()])
        </form>
    </div>
@endsection
