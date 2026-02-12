@extends('layouts.app')

@section('title', 'Mon compte - PC Shop')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Mon compte</h1>

    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    @if ($errors->has('current_password'))
        <x-alert type="error">
            {{ $errors->first('current_password') }}
        </x-alert>
    @endif

    <div class="grid md:grid-cols-2 gap-8">
        {{-- COLONNE PROFIL --}}
        <div class="space-y-6">
            {{-- Infos perso --}}
            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <h2 class="text-lg font-semibold mb-4">Informations personnelles</h2>

                <form method="POST" action="{{ route('account.updateProfile') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Nom complet</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                            required
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <x-button>
                            Enregistrer
                        </x-button>
                    </div>
                </form>
            </div>

            {{-- Mot de passe --}}
            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <h2 class="text-lg font-semibold mb-4">Modifier mon mot de passe</h2>

                <form method="POST" action="{{ route('account.updatePassword') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="current_password" class="block text-sm font-medium mb-1">Mot de passe actuel</label>
                        <input id="current_password" name="current_password" type="password" required
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium mb-1">Nouveau mot de passe</label>
                        <input id="password" name="password" type="password" required
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500">
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirmation</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500">
                    </div>

                    <div class="flex justify-end pt-2">
                        <x-button variant="secondary">
                            Mettre à jour le mot de passe
                        </x-button>
                    </div>
                </form>
            </div>
        </div>

        {{-- COLONNE HISTORIQUE DE COMMANDES --}}
        <div>
            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <h2 class="text-lg font-semibold mb-4">Mes commandes</h2>

                @if ($orders->isEmpty())
                    <p class="text-sm text-slate-600 dark:text-slate-300">
                        Vous n’avez pas encore passé de commande.
                    </p>
                @else
                    <div class="space-y-4">
                        @foreach ($orders as $order)
                            <div class="border border-slate-200 dark:border-slate-700 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-sm font-semibold">
                                        Commande #{{ $order->id }}
                                    </div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>

                                <div class="text-xs text-slate-500 dark:text-slate-400 mb-2">
                                    Statut :
                                    <span class="font-semibold">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    • {{ $order->items->count() }} article(s)
                                </div>

                                <div class="text-sm font-bold text-brand-600 dark:text-brand-200">
                                    Total : {{ number_format($order->total, 2, ',', ' ') }} €
                                </div>

                                <a href="{{ route('orders.show', $order) }}"
                                    class="text-xs text-brand-600 hover:underline">
                                    Voir le détail →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
