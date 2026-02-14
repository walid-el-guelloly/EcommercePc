@extends('layouts.app')

@section('title', 'Inscription - PC Shop')

@section('content')
    <div class="min-h-[70vh] flex items-start md:items-center justify-center">
        <div class="w-full max-w-md">
            <div class="mb-6 text-center">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Créer un compte</h1>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    En créant un compte, vous pouvez suivre vos commandes et retrouver vos informations facilement.
                </p>
            </div>

            @if(session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-3xl p-6 shadow-soft">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-medium">
                            Nom complet *
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            class="input-soft"
                        >
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-medium">
                            Email *
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="input-soft"
                        >
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="block text-sm font-medium">
                            Mot de passe *
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="input-soft"
                        >
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-sm font-medium">
                            Confirmer le mot de passe *
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="input-soft"
                        >
                    </div>

                    <div class="pt-2">
                        <x-button class="w-full justify-center">
                            Créer mon compte
                        </x-button>
                    </div>

                    <div class="pt-1 text-center text-xs text-slate-600 dark:text-slate-300">
                        Déjà un compte ?
                        <a href="{{ route('login') }}" class="text-brand-600 hover:underline">
                            Se connecter
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection