@extends('layouts.admin')

@section('header', 'Produits')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base font-semibold">Liste des produits</h2>
        <a href="{{ route('admin.products.create') }}">
            <x-button size="sm">Nouveau produit</x-button>
        </a>
    </div>

    {{-- <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-800 text-slate-300 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Produit</th>
                    <th class="px-4 py-3 text-left">Catégorie</th>
                    <th class="px-4 py-3 text-right">Prix</th>
                    <th class="px-4 py-3 text-right">Stock</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @foreach ($products as $product)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-100">{{ $product->name }}</div>
                            <div class="text-xs text-slate-500">#{{ $product->id }} · {{ $product->slug }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-300">
                            {{ $product->category?->name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-right text-brand-400 font-semibold">
                            {{ number_format($product->price, 2, ',', ' ') }} €
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="{{ $product->stock > 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-brand-400 hover:underline mr-2">
                                Éditer
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:underline">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-soft">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-800/80 text-slate-300 text-[11px] uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Produit</th>
                    <th class="px-4 py-3 text-left">Catégorie</th>
                    <th class="px-4 py-3 text-right">Prix</th>
                    <th class="px-4 py-3 text-right">Stock</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @foreach ($products as $product)
                    <tr class="hover:bg-slate-800/60 transition">
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-100">{{ $product->name }}</div>
                            <div class="text-xs text-slate-500">#{{ $product->id }} · {{ $product->slug }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-300">
                            {{ $product->category?->name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-right text-brand-400 font-semibold">
                            {{ number_format($product->price, 2, ',', ' ') }} €
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="{{ $product->stock > 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="text-xs text-brand-300 hover:underline mr-2">
                                Éditer
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                onsubmit="return confirm('Supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:underline">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
