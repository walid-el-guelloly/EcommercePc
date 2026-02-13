{{-- resources/views/orders/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Commande #' . $order->id . ' - PC Shop')

@section('content')
    {{-- Bandeau étapes : Mon panier → Validation → Commande terminée --}}
    <x-checkout-steps current="done" />

    <div class="mt-6">
        @if (session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif

        <h1 class="text-2xl font-bold mb-4">Commande #{{ $order->id }}</h1>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Colonne principale : infos commande + adresses + articles --}}
            <div
                class="md:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-soft">
                {{-- En‑tête commande --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            Passée le {{ $order->created_at->format('d/m/Y à H:i') }}
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            Dernière mise à jour : {{ $order->updated_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Statut</div>
                        @php
                            $status = $order->status;
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if ($status === 'pending') bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-200
                            @elseif($status === 'confirmed' || $status === 'paid')
                                bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200
                            @elseif($status === 'shipped')
                                bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-200
                            @elseif($status === 'cancelled')
                                bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-200
                            @else
                                bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200 @endif
                        ">
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                </div>

                <div class="flex items-baseline justify-between mb-4">
                    <div class="text-xs text-slate-500 dark:text-slate-400">
                        Total commande
                    </div>
                    <div class="text-2xl font-bold text-brand-600 dark:text-brand-200">
                        {{ number_format($order->total, 2, ',', ' ') }} €
                    </div>
                </div>

                <hr class="my-4 border-slate-200 dark:border-slate-700">

                {{-- Adresses livraison / facturation --}}
                <div class="grid md:grid-cols-2 gap-4 text-sm text-slate-700 dark:text-slate-200 mb-4">
                    <div>
                        <h3 class="font-semibold mb-1">Livraison</h3>
                        @if ($order->shipping_name)
                            <p>{{ $order->shipping_name }}</p>
                        @endif
                        @if ($order->shipping_address)
                            <p>{{ $order->shipping_address }}</p>
                        @endif
                        @if ($order->shipping_postal_code || $order->shipping_city)
                            <p>{{ $order->shipping_postal_code }} {{ $order->shipping_city }}</p>
                        @endif
                        @if ($order->shipping_country)
                            <p>{{ $order->shipping_country }}</p>
                        @endif
                        @if ($order->shipping_phone)
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                Tél : {{ $order->shipping_phone }}
                            </p>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold mb-1">Facturation</h3>
                        @if ($order->billing_name)
                            <p>{{ $order->billing_name }}</p>
                        @endif
                        @if ($order->billing_address)
                            <p>{{ $order->billing_address }}</p>
                        @endif
                        @if ($order->billing_postal_code || $order->billing_city)
                            <p>{{ $order->billing_postal_code }} {{ $order->billing_city }}</p>
                        @endif
                        @if ($order->billing_country)
                            <p>{{ $order->billing_country }}</p>
                        @endif
                        @if ($order->billing_phone)
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                Tél : {{ $order->billing_phone }}
                            </p>
                        @endif
                    </div>
                </div>

                <hr class="my-4 border-slate-200 dark:border-slate-700">

                {{-- Détail des articles --}}
                <h2 class="text-lg font-semibold mb-3">Détail des articles</h2>

                <div class="divide-y divide-slate-200 dark:divide-slate-700 text-sm">
                    @foreach ($order->items as $item)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <div class="font-medium">
                                    {{ $item->product_name }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ $item->quantity }} × {{ number_format($item->price, 2, ',', ' ') }} €
                                </div>
                            </div>
                            <div class="text-sm font-semibold text-brand-600 dark:text-brand-200">
                                {{ number_format($item->price * $item->quantity, 2, ',', ' ') }} €
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Colonne droite : actions / résumé rapide --}}
            <div class="space-y-4">
                <div
                    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft">
                    <h2 class="text-lg font-semibold mb-3">Résumé</h2>

                    <div class="flex items-center justify-between text-sm mb-2">
                        <span>Sous‑total</span>
                        <span>{{ number_format($order->total, 2, ',', ' ') }} €</span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 mb-2">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>

                    <hr class="my-3 border-slate-200 dark:border-slate-700">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-slate-600 dark:text-slate-300">Total payé / à payer</span>
                        <span class="text-xl font-bold text-brand-600 dark:text-brand-200">
                            {{ number_format($order->total, 2, ',', ' ') }} €
                        </span>
                    </div>

                    <a href="{{ route('account.index') }}" class="block text-sm text-brand-600 hover:underline mb-2">
                        ← Retour à mon compte
                    </a>
                    <a href="{{ route('products.index') }}" class="block text-sm text-brand-600 hover:underline">
                        Continuer mes achats
                    </a>
                </div>

                {{-- Bloc d'informations complémentaires --}}
                <div
                    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft text-xs text-slate-600 dark:text-slate-300">
                    <h3 class="font-semibold mb-2">Informations</h3>
                    <p class="mb-1">
                        Vous recevrez un email lorsque votre commande passera en statut
                        <span class="font-semibold">expédiée</span>.
                    </p>
                    <p>
                        Pour toute question, contactez‑nous via la section
                        <a href="#contact" class="text-brand-600 hover:underline">Contact</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
