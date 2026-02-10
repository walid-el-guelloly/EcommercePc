@props(['type' => 'success']) {{-- success, error, info --}}

@php
    $colors = [
        'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-200 dark:border-emerald-700',
        'error'   => 'bg-red-50 text-red-800 border-red-200 dark:bg-red-900/20 dark:text-red-200 dark:border-red-700',
        'info'    => 'bg-sky-50 text-sky-800 border-sky-200 dark:bg-sky-900/20 dark:text-sky-200 dark:border-sky-700',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'mb-4 px-4 py-3 border rounded-xl text-sm '.$colors[$type]]) }}>
    {{ $slot }}
</div>