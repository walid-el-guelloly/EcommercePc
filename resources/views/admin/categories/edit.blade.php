@extends('layouts.admin')

@section('header', 'Modifier la catégorie')

@section('content')
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-soft">
        <h2 class="text-base font-semibold mb-4">Modifier : {{ $category->name }}</h2>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @method('PUT')
            @include('admin.categories._form')
        </form>
    </div>
@endsection