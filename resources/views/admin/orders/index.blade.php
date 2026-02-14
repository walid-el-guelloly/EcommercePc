@extends('layouts.admin')

@section('header', 'Commandes')

@section('content')
    <h2 class="text-base font-semibold mb-4">Liste des commandes</h2>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-800 text-slate-300 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Commande</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-right">Total</th>
                    <th class="px-4 py-3 text-right">Date</th>
                    <th class="px-4 py-3 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-100">#{{ $order->id }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-300">
                            {{ $order->user?->name ?? 'Compte supprimé' }}<br>
                            <span class="text-xs text-slate-500">{{ $order->user?->email }}</span>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            {{ ucfirst($order->status) }}
                        </td>
                        <td class="px-4 py-3 text-right text-brand-400 font-semibold">
                            {{ number_format($order->total, 2, ',', ' ') }} €
                        </td>
                        <td class="px-4 py-3 text-right text-xs text-slate-400">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-xs text-brand-400 hover:underline">
                                Détail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
@endsection