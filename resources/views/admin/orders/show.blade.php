@extends('layouts.admin')

@section('header', 'Commande #'.$order->id)

@section('content')
    <div class="grid md:grid-cols-3 gap-8">
        {{-- Infos + lignes (on reprend la vue front mais en mode admin / compact) --}}
        <div class="md:col-span-2 bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-soft">
            <div class="flex items-center justify-between mb-3">
                <div class="text-sm">
                    <div class="text-slate-200 font-semibold">
                        Client : {{ $order->user?->name ?? 'Compte supprimé' }}
                    </div>
                    <div class="text-xs text-slate-400">
                        {{ $order->user?->email }}
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-slate-400">Total</div>
                    <div class="text-xl font-bold text-brand-400">
                        {{ number_format($order->total, 2, ',', ' ') }} €
                    </div>
                </div>
            </div>

            <div class="text-xs text-slate-500 mb-3">
                Passée le {{ $order->created_at->format('d/m/Y H:i') }}
            </div>

            <hr class="my-3 border-slate-800">

            {{-- Adresses --}}
            <div class="grid md:grid-cols-2 gap-4 text-xs text-slate-200 mb-4">
                <div>
                    <h3 class="font-semibold mb-1">Livraison</h3>
                    <p>{{ $order->shipping_name }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->shipping_postal_code }} {{ $order->shipping_city }}</p>
                    <p>{{ $order->shipping_country }}</p>
                    @if($order->shipping_phone)
                        <p class="mt-1 text-slate-400">Tél : {{ $order->shipping_phone }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="font-semibold mb-1">Facturation</h3>
                    <p>{{ $order->billing_name }}</p>
                    <p>{{ $order->billing_address }}</p>
                    <p>{{ $order->billing_postal_code }} {{ $order->billing_city }}</p>
                    <p>{{ $order->billing_country }}</p>
                    @if($order->billing_phone)
                        <p class="mt-1 text-slate-400">Tél : {{ $order->billing_phone }}</p>
                    @endif
                </div>
            </div>

            <hr class="my-3 border-slate-800">

            <h3 class="text-sm font-semibold mb-2">Articles</h3>
            <div class="divide-y divide-slate-800 text-sm">
                @foreach($order->items as $item)
                    <div class="py-2 flex items-center justify-between">
                        <div>
                            <div class="text-slate-100 font-medium">{{ $item->product_name }}</div>
                            <div class="text-xs text-slate-400">
                                {{ $item->quantity }} × {{ number_format($item->price, 2, ',', ' ') }} €
                            </div>
                        </div>
                        <div class="text-brand-400 font-semibold">
                            {{ number_format($item->price * $item->quantity, 2, ',', ' ') }} €
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Colonne droite : statut --}}
        <div class="space-y-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-soft text-sm">
                <h3 class="font-semibold mb-3">Statut de la commande</h3>

                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <select name="status" class="input-soft">
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" @selected($order->status === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    <x-button class="w-full justify-center">
                        Mettre à jour
                    </x-button>
                </form>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-soft text-xs text-slate-400">
                <p class="mb-1">
                    Utilisez ces statuts pour suivre le cycle de vie de la commande :
                </p>
                <ul class="list-disc list-inside space-y-1 mt-1">
                    <li><b>pending</b> : en attente</li>
                    <li><b>confirmed / paid</b> : confirmée / payée</li>
                    <li><b>shipped</b> : expédiée</li>
                    <li><b>completed</b> : terminée</li>
                    <li><b>cancelled</b> : annulée</li>
                </ul>
            </div>
        </div>
    </div>
@endsection