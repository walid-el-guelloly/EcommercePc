@props([
    'variant' => 'primary', // primary, secondary, outline
    'size' => 'md', // sm, md
])

@php
    $base = 'inline-flex items-center justify-center rounded-full font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 disabled:opacity-50 disabled:cursor-not-allowed';
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
    ];
    $variants = [
        'primary' => 'bg-brand-600 text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-600',
        'secondary' => 'bg-slate-100 text-slate-800 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-100 dark:hover:bg-slate-600',
        'outline' => 'border border-slate-300 text-slate-700 hover:bg-slate-100 dark:border-slate-500 dark:text-slate-100 dark:hover:bg-slate-700',
    ];
@endphp

<button {{ $attributes->merge(['class' => $base.' '.$sizes[$size].' '.$variants[$variant]]) }} type="submit">
    {{ $slot }}
</button>