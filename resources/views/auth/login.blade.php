@extends('layouts.app')

@section('title', 'Connexion - PC Shop')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4 text-center">Connexion</h1>

            @if(session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            @if($errors->any())
                <x-alert type="error">
                    {{ $errors->first() }}
                </x-alert>
            @endif

            <form method="POST" action="{{ route('login') }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-soft space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email *</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
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

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-1 text-xs text-slate-600 dark:text-slate-300">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 dark:border-slate-600">
                        <span>Se souvenir de moi</span>
                    </label>

                    {{-- plus tard : lien mot de passe oublié --}}
                    {{-- <a href="#" class="text-xs text-slate-500 hover:underline">Mot de passe oublié ?</a> --}}
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('register') }}" class="text-xs text-slate-500 hover:underline">
                        Pas encore de compte ? S’inscrire
                    </a>
                    <x-button>
                        Se connecter
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection