@extends('layouts.app')

@section('title', 'Inscription - PC Shop')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4 text-center">Créer un compte</h1>

            @if(session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            <form method="POST" action="{{ route('register') }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-soft space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium mb-1">Nom complet *</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                    >
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email *</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                    >
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Mot de passe *</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                    >
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirmer le mot de passe *</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                    >
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('login') }}" class="text-xs text-slate-500 hover:underline">
                        Déjà un compte ? Se connecter
                    </a>
                    <x-button>
                        Créer mon compte
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection