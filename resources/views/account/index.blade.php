@extends('layouts.app')

@section('title', 'Mon compte - PC Shop')

@section('content')
    <div class="max-w-5xl mx-auto">
        {{-- En-tête --}}
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold mb-1">Mon compte</h1>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Gérez vos informations personnelles et consultez l’historique de vos commandes.
                </p>
            </div>
            <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-300">
                <div class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800">
                    {{ $user->email }}
                </div>
                <div class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800">
                    {{ $orders->count() }} commande{{ $orders->count() > 1 ? 's' : '' }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif

        @if($errors->has('current_password'))
            <x-alert type="error">
                {{ $errors->first('current_password') }}
            </x-alert>
        @endif

        <div class="grid md:grid-cols-3 gap-6">
            {{-- Colonne gauche : profil + mot de passe --}}
            <div class="md:col-span-2 space-y-6">
                {{-- Informations personnelles --}}
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-5 shadow-soft">
                    <h2 class="text-base font-semibold mb-1">Informations personnelles</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                        Modifiez votre nom ou votre adresse email.
                    </p>

                    <form method="POST" action="{{ route('account.updateProfile') }}" class="space-y-4 text-sm">
                        @csrf

                        <div>
                            <label for="name" class="block text-xs font-medium mb-1">Nom complet</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $user->name) }}"
                                required
                                autocomplete="name"
                                class="input-soft"
                            >
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-medium mb-1">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                autocomplete="email"
                                class="input-soft"
                            >
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2 flex justify-end">
                            <x-button>
                                Enregistrer
                            </x-button>
                        </div>
                    </form>
                </div>

                {{-- Modifier mot de passe --}}
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-5 shadow-soft">
                    <h2 class="text-base font-semibold mb-1">Modifier mon mot de passe</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                        Choisissez un mot de passe sécurisé que vous n’utilisez pas ailleurs.
                    </p>

                    <form method="POST" action="{{ route('account.updatePassword') }}" class="space-y-4 text-sm">
                        @csrf

                        <div>
                            <label for="current_password" class="block text-xs font-medium mb-1">
                                Mot de passe actuel
                            </label>
                            <input
                                id="current_password"
                                name="current_password"
                                type="password"
                                required
                                autocomplete="current-password"
                                class="input-soft"
                            >
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-medium mb-1">
                                Nouveau mot de passe
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

                        <div>
                            <label for="password_confirmation" class="block text-xs font-medium mb-1">
                                Confirmation
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

                        <div class="pt-2 flex justify-end">
                            <x-button variant="secondary">
                                Mettre à jour le mot de passe
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Colonne droite : historique commandes --}}
            <div>
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-5 shadow-soft">
                    <h2 class="text-base font-semibold mb-1">Mes commandes</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                        Historique des dernières commandes passées sur PC Shop.
                    </p>

                    @if($orders->isEmpty())
                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            Vous n’avez pas encore passé de commande.
                        </p>
                    @else
                        <div class="space-y-3 text-sm">
                            @foreach($orders->take(5) as $order)
                                <a href="{{ route('orders.show', $order) }}"
                                   class="block rounded-2xl border border-slate-200 dark:border-slate-700 px-3 py-2.5
                                          hover:border-brand-500/70 hover:bg-brand-500/5 transition">
                                    <div class="flex items-center justify-between gap-2">
                                        <div>
                                            <div class="font-semibold text-slate-800 dark:text-slate-100">
                                                Commande #{{ $order->id }}
                                            </div>
                                            <div class="text-xs text-slate-500 dark:text-slate-400">
                                                {{ $order->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-xs mb-1">
                                                @php $status = $order->status; @endphp
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium
                                                    @if($status === 'pending')
                                                        bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-200
                                                    @elseif(in_array($status, ['confirmed','paid']))
                                                        bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200
                                                    @elseif($status === 'shipped')
                                                        bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-200
                                                    @elseif($status === 'completed')
                                                        bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200
                                                    @else
                                                        bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-200
                                                    @endif
                                                ">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </div>
                                            <div class="text-sm font-semibold text-brand-600 dark:text-brand-300">
                                                {{ number_format($order->total, 2, ',', ' ') }} €
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        @if($orders->count() > 5)
                            <div class="mt-3 text-xs text-slate-500 dark:text-slate-400">
                                <a href="{{ route('account.index') }}"
                                   class="text-brand-600 hover:underline">
                                    Voir toutes les commandes dans votre historique.
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection