@extends('layouts.app')

@section('title', 'Contact - PC Shop')

@section('content')
    <section class="mb-8">
        <p class="text-xs uppercase tracking-wide text-brand-600 mb-2">
            Contact
        </p>
        <h1 class="text-3xl font-bold mb-2">
            Contactez-nous
        </h1>
        <p class="text-slate-600 dark:text-slate-300 max-w-2xl">
            Une question sur un produit, une configuration ou une commande ?
            Remplissez le formulaire ou utilisez les informations de contact ci-dessous.
        </p>
    </section>

    <section class="grid md:grid-cols-2 gap-8">
        {{-- Infos de contact --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <h2 class="text-lg font-semibold mb-3">Nos coordonnées</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-3">
                    Nous répondons généralement sous 24 à 48h les jours ouvrés.
                </p>
                <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
                    <li><span class="font-semibold">Email :</span> support@pcshop.test</li>
                    <li><span class="font-semibold">Téléphone :</span> +33 1 23 45 67 89</li>
                    <li><span class="font-semibold">Horaires :</span> Lun–Ven, 9h–18h</li>
                </ul>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5">
                <h2 class="text-lg font-semibold mb-3">Pourquoi nous contacter ?</h2>
                <ul class="list-disc list-inside text-sm text-slate-600 dark:text-slate-300 space-y-1">
                    <li>Conseils pour choisir vos composants</li>
                    <li>Vérifier la compatibilité de votre configuration</li>
                    <li>Suivi d’une commande ou d’une livraison</li>
                    <li>Problème technique ou demande de retour</li>
                </ul>
            </div>
        </div>

        {{-- Formulaire de contact --}}
        <div>
            @if(session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium mb-1">Nom complet *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                        required
                    >
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                        required
                    >
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium mb-1">Sujet</label>
                    <input
                        type="text"
                        id="subject"
                        name="subject"
                        value="{{ old('subject') }}"
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                    >
                    @error('subject')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium mb-1">Message *</label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                        required
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-button>
                        Envoyer le message
                    </x-button>
                </div>
            </form>
        </div>
    </section>
@endsection