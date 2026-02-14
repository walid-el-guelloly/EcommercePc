@extends('layouts.admin')

@section('header', 'Nouvelle catégorie')

@section('content')
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-soft">
        <h2 class="text-base font-semibold mb-4">Créer une catégorie</h2>

        <form method="POST" action="{{ route('admin.categories.store') }}">
            @include('admin.categories._form')
        </form>
    </div>
@endsection