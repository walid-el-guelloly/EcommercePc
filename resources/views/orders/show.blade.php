@extends('layouts.app')

@section('title', 'Commande #' . $order->id . ' - PC Shop')

@section('content')
    <x-checkout-steps current="done" />
    <h1 class="text-2xl font-bold mb-4">Commande #{{ $order->id }}</h1>

    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    <div class="grid md:grid-cols-3 gap-8">
        {{-- Infos commande --}}
        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft md:col-span-2">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-sm text-slate-500 dark:text-slate-400">
                        Passée le {{ $order->created_at->format('d/m/Y à H:i') }}
                    </div>
                    <div class="text-sm mt-1">
                        Statut :
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs
                            @if ($order->status === 'confirmed') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-200
                            @elseif($order->status === 'pending')
                                bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-200
                            @else
                                bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200 @endif
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-slate-500 dark:text-slate-400">Total</div>
                    <div class="text-xl font-bold text-brand-600 dark:text-brand-200">
                        {{ number_format($order->total, 2, ',', ' ') }} €
                    </div>
                </div>
            </div>

            <hr class="my-4 border-slate-200 dark:border-slate-700">

            <h2 class="text-lg font-semibold mb-3">Détail des articles</h2>

            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                @foreach ($order->items as $item)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <div class="font-medium text-sm">
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

        {{-- Raccourcis --}}
        <div class="space-y-4">
            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <h2 class="text-lg font-semibold mb-3">Actions</h2>
                <a href="{{ route('account.index') }}" class="text-sm text-brand-600 hover:underline block mb-2">
                    ← Retour à mon compte
                </a>
                <a href="{{ route('products.index') }}" class="text-sm text-brand-600 hover:underline block">
                    Continuer mes achats
                </a>
            </div>
        </div>
    </div>
@endsection
