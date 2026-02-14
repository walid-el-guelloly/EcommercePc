@extends('layouts.admin')

@section('header', 'Modifier le produit')

@section('content')
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-soft">
        <h2 class="text-base font-semibold mb-4">Modifier : {{ $product->name }}</h2>
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.products._form', ['product' => $product])
        </form>
    </div>
@endsection
