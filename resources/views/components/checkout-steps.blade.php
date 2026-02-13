@props([
    'current' => 'cart', // cart, checkout, done
])

@php
    $steps = [
        'cart'     => 'Mon panier',
        'checkout' => 'Validation de la commande',
        'done'     => 'Commande terminée',
    ];

    $order = ['cart', 'checkout', 'done'];
@endphp

<div class="bg-brand-600 text-white">
    <div class="max-w-7xl mx-auto px-4 py-4 text-sm font-semibold flex flex-wrap gap-2 items-center">
        @foreach($order as $index => $key)
            <span class="{{ $current === $key ? 'underline' : 'opacity-80' }}">
                {{ $steps[$key] }}
            </span>
            @if($index < count($order) - 1)
                <span class="opacity-70 mx-1">→</span>
            @endif
        @endforeach
    </div>
</div>