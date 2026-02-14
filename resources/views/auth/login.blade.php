@extends('layouts.app')

@section('title', 'Connexion - PC Shop')

@section('content')
    <div class="min-h-[70vh] flex items-start md:items-center justify-center">
        <div class="w-full max-w-md">
            <div class="mb-6 text-center">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Connexion</h1>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Accédez à votre espace PC Shop pour suivre vos commandes et vos achats.
                </p>
            </div>

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

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-3xl p-6 shadow-soft">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

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
                            autofocus
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
                            autocomplete="current-password"
                            class="input-soft"
                        >
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-300">
                        <label class="inline-flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-slate-300 dark:border-slate-600 text-brand-600 focus:ring-brand-500"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <span>Se souvenir de moi</span>
                        </label>

                        {{-- Plus tard : mot de passe oublié --}}
                        {{-- <a href="#" class="hover:text-brand-600">Mot de passe oublié ?</a> --}}
                    </div>

                    <div class="pt-2">
                        <x-button class="w-full justify-center">
                            Se connecter
                        </x-button>
                    </div>

                    <div class="pt-1 text-center text-xs text-slate-600 dark:text-slate-300">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" class="text-brand-600 hover:underline">
                            S’inscrire
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection