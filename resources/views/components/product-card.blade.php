@props([
    'product',
    'compact' => false,
    'showCategory' => true,
    'showAddButton' => true,
])

@php
    use Illuminate\Support\Str;
@endphp

<article {{ $attributes->merge([
    'class' => 'group bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl shadow-soft hover:shadow-lg transition flex flex-col'
]) }}>
    <div class="{{ $compact ? 'h-32' : 'h-40' }} bg-slate-50 dark:bg-slate-700 flex items-center justify-center rounded-t-2xl overflow-hidden">
        @if($product->image_path)
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="max-h-full object-contain">
        @else
            <span class="text-xs text-slate-400">Image à venir</span>
        @endif
    </div>

    <div class="p-4 flex-1 flex flex-col">
        @if($showCategory && $product->category)
            <div class="text-[11px] uppercase tracking-wide text-slate-500 dark:text-slate-400 mb-1">
                {{ $product->category->name }}
            </div>
        @endif

        <h3 class="font-semibold text-sm mb-1 group-hover:text-brand-600">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>

        <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 flex-1">
            {{ Str::limit($product->description, $compact ? 60 : 80) }}
        </p>

        <div class="mt-auto flex items-center justify-between pt-2">
            <div class="text-base font-bold text-brand-600 dark:text-brand-100">
                {{ number_format($product->price, 2, ',', ' ') }} €
            </div>

            @if($showAddButton)
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <x-button size="sm">
                        Ajouter
                    </x-button>
                </form>
            @else
                <a href="{{ route('products.show', $product->slug) }}" class="text-xs text-brand-600 dark:text-brand-300 hover:underline">
                    Voir →
                </a>
            @endif
        </div>
    </div>
</article>