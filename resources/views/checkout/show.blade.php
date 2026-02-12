@extends('layouts.app')

@section('title', 'Finaliser ma commande - PC Shop')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Finaliser ma commande</h1>

    @if($errors->has('checkout'))
        <x-alert type="error">
            {{ $errors->first('checkout') }}
        </x-alert>
    @endif

    @if(session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    <div class="grid md:grid-cols-3 gap-8">
        {{-- Récap produits --}}
        <div class="md:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
            <h2 class="text-lg font-semibold mb-4">Votre panier</h2>

            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                @foreach($cart as $productId => $item)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <div class="font-medium text-sm">
                                {{ $item['name'] }}
                            </div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">
                                Quantité : {{ $item['quantity'] }}
                            </div>
                        </div>
                        <div class="text-sm font-semibold text-brand-600 dark:text-brand-200">
                            {{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} €
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Résumé & confirmation --}}
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
            <h2 class="text-lg font-semibold mb-4">Récapitulatif</h2>

            <div class="flex items-center justify-between mb-2 text-sm">
                <span>Total produits</span>
                <span>{{ number_format($total, 2, ',', ' ') }} €</span>
            </div>

            {{-- plus tard : ajouter livraison, TVA, etc. --}}

            <hr class="my-3 border-slate-200 dark:border-slate-700">

            <div class="flex items-center justify-between mb-4">
                <span class="font-semibold">Total à payer</span>
                <span class="text-xl font-bold text-brand-600 dark:text-brand-200">
                    {{ number_format($total, 2, ',', ' ') }} €
                </span>
            </div>

            <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                En cliquant sur “Confirmer la commande”, votre commande sera enregistrée.
                Le paiement en ligne pourra être ajouté ultérieurement.
            </p>

            <form method="POST" action="{{ route('checkout.process') }}" class="space-y-3">
                @csrf

                <x-button class="w-full justify-center">
                    Confirmer la commande
                </x-button>

                <a href="{{ route('cart.index') }}" class="block text-center text-xs text-slate-500 hover:text-brand-600">
                    ← Retour au panier
                </a>
            </form>
        </div>
    </div>
@endsection