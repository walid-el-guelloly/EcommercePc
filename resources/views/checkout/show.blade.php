@extends('layouts.app')

@section('title', 'Finaliser ma commande - PC Shop')

@section('content')
    <x-checkout-steps current="checkout" />

    <div class="mt-6">
        @if($errors->has('checkout'))
            <x-alert type="error">
                {{ $errors->first('checkout') }}
            </x-alert>
        @endif

        {{-- Formulaire global : adresses + confirmation --}}
        <form method="POST" action="{{ route('checkout.process') }}" class="grid md:grid-cols-3 gap-8">
            @csrf

            {{-- Colonne 1 : adresse de livraison --}}
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft">
                    <h2 class="text-lg font-semibold mb-4">Adresse de livraison</h2>

                    <div class="space-y-3 text-sm">
                        <div>
                            <label class="block text-xs font-medium mb-1">Nom complet *</label>
                            <input
                                type="text"
                                name="shipping_name"
                                value="{{ old('shipping_name', $user->name) }}"
                                required
                                class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                            >
                            @error('shipping_name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium mb-1">Adresse *</label>
                            <input
                                type="text"
                                name="shipping_address"
                                value="{{ old('shipping_address') }}"
                                required
                                class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                            >
                            @error('shipping_address')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium mb-1">Ville *</label>
                                <input
                                    type="text"
                                    name="shipping_city"
                                    value="{{ old('shipping_city') }}"
                                    required
                                    class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                                >
                                @error('shipping_city')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium mb-1">Code postal</label>
                                <input
                                    type="text"
                                    name="shipping_postal_code"
                                    value="{{ old('shipping_postal_code') }}"
                                    class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                                >
                                @error('shipping_postal_code')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium mb-1">Pays</label>
                                <input
                                    type="text"
                                    name="shipping_country"
                                    value="{{ old('shipping_country', 'Maroc') }}"
                                    class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                                >
                                @error('shipping_country')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium mb-1">Téléphone</label>
                                <input
                                    type="text"
                                    name="shipping_phone"
                                    value="{{ old('shipping_phone') }}"
                                    class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                                >
                                @error('shipping_phone')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Adresse facturation (optionnelle) --}}
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-lg font-semibold">Adresse de facturation</h2>
                        <label class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-300">
                            <input
                                type="checkbox"
                                name="billing_same_as_shipping"
                                value="1"
                                {{ old('billing_same_as_shipping', '1') ? 'checked' : '' }}
                                class="rounded border-slate-300 dark:border-slate-600"
                            >
                            <span>Même que la livraison</span>
                        </label>
                    </div>

                    {{-- Si besoin tu pourras plus tard ajouter des champs séparés (billing_*) et les afficher/masquer en JS --}}
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Si vous décochez cette case, vous pourrez ajouter une adresse de facturation différente
                        (à implémenter plus tard). Pour l’instant, nous utilisons l’adresse de livraison.
                    </p>
                </div>
            </div>

            {{-- Colonne 2 : récap panier + total + bouton --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft">
                    <h2 class="text-lg font-semibold mb-4">Votre panier</h2>

                    <div class="divide-y divide-slate-200 dark:divide-slate-700 text-sm">
                        @foreach($cart as $item)
                            <div class="py-2 flex items-center justify-between">
                                <div>
                                    <div class="font-medium">{{ $item['name'] }}</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">
                                        {{ $item['quantity'] }} × {{ number_format($item['price'], 2, ',', ' ') }} €
                                    </div>
                                </div>
                                <div class="font-semibold text-brand-600 dark:text-brand-200">
                                    {{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} €
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft">
                    <h2 class="text-lg font-semibold mb-4">Total</h2>

                    <div class="flex items-center justify-between mb-2 text-sm">
                        <span>Sous‑total</span>
                        <span>{{ number_format($total, 2, ',', ' ') }} €</span>
                    </div>
                    <div class="flex items-center justify-between mb-2 text-xs text-slate-500 dark:text-slate-400">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>

                    <hr class="my-3 border-slate-200 dark:border-slate-700">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-slate-600 dark:text-slate-300">Total à payer</span>
                        <span class="text-xl font-bold text-brand-600 dark:text-brand-200">
                            {{ number_format($total, 2, ',', ' ') }} €
                        </span>
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white
                               bg-gradient-to-r from-brand-600 to-accent-500 hover:from-brand-700 hover:to-accent-600
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 focus:ring-offset-slate-50
                               dark:focus:ring-offset-slate-900">
                        Confirmer la commande
                    </button>

                    <a href="{{ route('cart.index') }}" class="mt-3 block text-center text-xs text-slate-500 hover:text-brand-600">
                        ← Retour au panier
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection