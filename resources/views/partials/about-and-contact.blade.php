{{-- resources/views/partials/about-and-contact.blade.php --}}

{{-- ABOUT SECTION – style hero avec image à gauche, texte à droite --}}
<section id="about" data-section-id="about" class="scroll-mt-32 mb-16">
    <div
        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-soft overflow-hidden">
        <div class="grid md:grid-cols-2">
            {{-- Image --}}
            <div class="relative bg-slate-100 dark:bg-slate-800">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80"
                    alt="Équipe informatique au travail" class="w-full h-full object-cover">
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
{{-- CONTACT SECTION – 2 colonnes, infos + formulaire --}}
<section id="contact" data-section-id="contact" class="scroll-mt-32 mb-16">
    <div
        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-soft p-6 md:p-8">
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

                <ul class="space-y-3 text-sm text-slate-200">
                    {{-- Email --}}
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-800">
                            {{-- Icône mail (SVG) --}}
                            <svg class="w-4 h-4 text-slate-200" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 6H20C21.1 6 22 6.9 22 8V16C22 17.1 21.1 18 20 18H4C2.9 18 2 17.1 2 16V8C2 6.9 2.9 6 4 6Z"
                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M22 8L12 13L2 8" stroke="currentColor" stroke-width="1.6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="text-slate-500 dark:text-slate-100">support@pcshop.test</span>
                    </li>

                    {{-- Adresse --}}
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-800">
                            {{-- Icône localisation --}}
                            <svg class="w-4 h-4 text-slate-200" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 21C12 21 5 14.9706 5 10C5 6.68629 7.68629 4 11 4C14.3137 4 17 6.68629 17 10C17 14.9706 12 21 12 21Z"
                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <circle cx="12" cy="10" r="2" stroke="currentColor" stroke-width="1.6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="text-slate-500 dark:text-slate-100">
                            Adresse boutique / entrepôt
                        </span>
                    </li>

                    {{-- Téléphone --}}
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-800">
                            {{-- Icône téléphone --}}
                            <svg class="w-4 h-4 text-slate-200" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.5 4H9L10.5 8L8.5 9C9.3 10.6 10.4 11.7 12 12.5L13 10.5L17 12V14.5C17 15.3284 16.3284 16 15.5 16C10.8056 16 7 12.1944 7 7.5C7 6.67157 6.82843 6 6.5 6V4Z"
                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="text-slate-500 dark:text-slate-100">
                            +212 694972457
                        </span>
                    </li>
                </ul>
            </div>

            {{-- Colonne droite : formulaire stylé --}}
            <div>
                @if (session('success'))
                    <x-alert type="success">
                        {{ session('success') }}
                    </x-alert>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-3">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-3">
                        <div>
                            <input type="text" name="name" placeholder="Nom complet *" value="{{ old('name') }}"
                                required class="input-soft">
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input type="email" name="email" placeholder="Email *" value="{{ old('email') }}"
                                required class="input-soft">
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <input type="text" name="subject" placeholder="Sujet (facultatif)"
                            value="{{ old('subject') }}" class="input-soft">
                        @error('subject')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <textarea name="message" rows="4" placeholder="Votre message *" required class="input-soft">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-1">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white
                                   bg-gradient-to-r from-brand-600 to-accent-500 hover:from-brand-700 hover:to-accent-600
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 focus:ring-offset-slate-900">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
