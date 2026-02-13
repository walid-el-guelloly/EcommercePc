{{-- resources/views/partials/about-and-contact.blade.php --}}

{{-- ABOUT SECTION – style hero avec image à gauche, texte à droite --}}
<section id="about" data-section-id="about" class="scroll-mt-32 mb-16">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-soft overflow-hidden">
        <div class="grid md:grid-cols-2">
            {{-- Image --}}
            <div class="relative bg-slate-100 dark:bg-slate-800">
                <img
                    src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80"
                    alt="Équipe informatique au travail"
                    class="w-full h-full object-cover"
                >
                <div class="absolute bottom-4 left-4 bg-black/50 text-white text-[11px] px-3 py-1 rounded-full">
                    Votre partenaire hardware
                </div>
            </div>

            {{-- Texte --}}
            <div class="p-8 md:p-10 flex flex-col justify-center">
                <div class="text-xs tracking-[0.2em] uppercase text-slate-500 dark:text-slate-400 mb-2">
                    À PROPOS
                </div>
                <h2 class="text-2xl md:text-3xl font-bold mb-4">
                    PC Shop, une boutique simple pour les passionnés de tech.
                </h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-4 max-w-xl">
                    Nous sélectionnons des composants et ordinateurs fiables, faciles à comprendre,
                    pour monter ou améliorer votre PC sans prise de tête.
                </p>
                <p class="text-sm text-slate-600 dark:text-slate-300 max-w-xl">
                    Que vous soyez gamer, créateur ou pro, nous vous aidons à trouver
                    les bonnes pièces au bon prix.
                </p>

                <div class="flex flex-wrap gap-3 mt-6 text-[11px] text-slate-600 dark:text-slate-300">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800">
                        Conseils sur la configuration
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800">
                        Produits testés
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800">
                        Support réactif
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CONTACT SECTION – 2 colonnes, infos à gauche, formulaire à droite, bouton gradient --}}
<section id="contact" data-section-id="contact" class="scroll-mt-32 mb-16">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-soft p-6 md:p-8">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Colonne gauche : titre + infos --}}
            <div>
                <div class="text-xs tracking-[0.2em] uppercase text-slate-500 dark:text-slate-400 mb-2">
                    CONTACT
                </div>
                <h2 class="text-2xl font-bold mb-3">
                    Parlons de votre projet ou de votre config PC.
                </h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-6 max-w-md">
                    Envoyez‑nous un message pour une question sur un produit,
                    une configuration ou une commande. On vous répond rapidement.
                </p>

                <ul class="space-y-3 text-sm text-slate-700 dark:text-slate-200">
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 inline-flex items-center justify-center w-7 h-7 rounded-full bg-brand-50 text-brand-600 text-xs">
                            @
                        </span>
                        <span>support@pcshop.test</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 inline-flex items-center justify-center w-7 h-7 rounded-full bg-brand-50 text-brand-600 text-xs">
                            📍
                        </span>
                        <span>Adresse boutique / entrepôt (optionnel)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 inline-flex items-center justify-center w-7 h-7 rounded-full bg-brand-50 text-brand-600 text-xs">
                            ☎
                        </span>
                        <span>+212 5 XX XX XX XX</span>
                    </li>
                </ul>
            </div>

            {{-- Colonne droite : formulaire stylé --}}
            <div>
                @if(session('success'))
                    <x-alert type="success">
                        {{ session('success') }}
                    </x-alert>
                @endif

                <form
                    action="{{ route('contact.submit') }}"
                    method="POST"
                    class="space-y-3"
                >
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-3">
                        <div>
                            <input
                                type="text"
                                name="name"
                                placeholder="Nom complet *"
                                value="{{ old('name') }}"
                                required
                                class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                            >
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input
                                type="email"
                                name="email"
                                placeholder="Email *"
                                value="{{ old('email') }}"
                                required
                                class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                            >
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <input
                            type="text"
                            name="subject"
                            placeholder="Sujet (facultatif)"
                            value="{{ old('subject') }}"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                        >
                        @error('subject')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <textarea
                            name="message"
                            rows="4"
                            placeholder="Votre message *"
                            required
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bouton gradient type design montré --}}
                    <div class="pt-1">
                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white
                                   bg-gradient-to-r from-brand-600 to-accent-500 hover:from-brand-700 hover:to-accent-600
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 focus:ring-offset-slate-50
                                   dark:focus:ring-offset-slate-900"
                        >
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>