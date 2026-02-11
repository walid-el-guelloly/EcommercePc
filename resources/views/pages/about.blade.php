@extends('layouts.app')

@section('title', 'À propos - PC Shop')

@section('content')
    <section class="mb-10">
        <p class="text-xs uppercase tracking-wide text-brand-600 mb-2">
            À propos
        </p>
        <h1 class="text-3xl font-bold mb-4">
            Qui sommes-nous ?
        </h1>
        <p class="text-slate-600 dark:text-slate-300 max-w-2xl">
            PC Shop est une boutique en ligne spécialisée dans les composants informatiques :
            processeurs, cartes graphiques, mémoire, stockage, cartes mères, et bien plus encore.
            Notre objectif : vous aider à monter le PC qui correspond exactement à vos besoins,
            que ce soit pour le gaming, la création ou un usage professionnel.
        </p>
    </section>

    {{-- Chiffres clés --}}
    <section class="mb-10 grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
            <div class="text-3xl font-bold text-brand-600 mb-1">+5 ans</div>
            <div class="text-sm font-semibold mb-1">d’expérience</div>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Une expertise construite autour du matériel PC et des dernières générations de composants.
            </p>
        </div>
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
            <div class="text-3xl font-bold text-brand-600 mb-1">24/7</div>
            <div class="text-sm font-semibold mb-1">boutique en ligne</div>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Commandez à tout moment, depuis chez vous, avec un suivi clair de vos commandes.
            </p>
        </div>
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
            <div class="text-3xl font-bold text-brand-600 mb-1">Support</div>
            <div class="text-sm font-semibold mb-1">personnalisé</div>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Nous vous aidons à choisir les bons composants compatibles entre eux.
            </p>
        </div>
    </section>

    {{-- Nos valeurs --}}
    <section class="mb-10">
        <h2 class="text-xl font-semibold mb-4">Nos valeurs</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5">
                <h3 class="font-semibold mb-2">Transparence</h3>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Des fiches produits détaillées, des prix clairs et aucune mauvaise surprise lors du paiement.
                </p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5">
                <h3 class="font-semibold mb-2">Performance</h3>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Nous sélectionnons des composants performants, testés et recommandés par la communauté.
                </p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5">
                <h3 class="font-semibold mb-2">Accompagnement</h3>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Vous n’êtes pas seul : notre équipe vous accompagne de la sélection des pièces jusqu’au montage.
                </p>
            </div>
        </div>
    </section>
@endsection