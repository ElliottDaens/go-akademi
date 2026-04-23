@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
    {{-- Hero --}}
    <section class="hero-secondary relative overflow-hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050505]/60 to-[#050505]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-red-600/8 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="relative text-center px-6 pt-20">
            <div class="inline-flex gap-2 bg-neutral-900/50 border-neutral-800 border rounded-full mb-6 py-1.5 px-4 items-center backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
                <span class="text-xs font-medium tracking-wide text-neutral-400 uppercase">Rejoindre l'académie</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-normal tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-400">S'INSCRIRE</h1>
        </div>
    </section>

    <div class="max-w-3xl mx-auto px-5 md:px-6 py-14 md:py-20">

        {{-- Flash success --}}
        @if(session('success'))
        <div class="mb-10 p-5 md:p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm flex items-start gap-4 animate-on-scroll">
            <iconify-icon icon="solar:check-circle-linear" style="font-size: 1.5rem; flex-shrink: 0;"></iconify-icon>
            <div>
                <p class="font-medium text-emerald-300 mb-1">Demande envoyée !</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <div class="animate-on-scroll mb-12">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-6 uppercase tracking-wider">
                <span class="text-red-500">Inscription</span>
                <span class="text-neutral-700">/</span>
                <span>Formulaire d'adhésion</span>
            </div>
            <h2 class="text-2xl font-normal tracking-tight text-white mb-4">Votre demande d'inscription</h2>
            <p class="text-neutral-400 font-light text-sm leading-relaxed max-w-2xl">
                Remplissez ce formulaire pour soumettre votre demande d'adhésion à la Go Akadémi. Nous vous recontacterons sous 48h pour finaliser votre inscription et vous accueillir sur le tatami.
            </p>
        </div>

        {{-- Errors --}}
        @if($errors->any())
        <div class="mb-8 p-5 bg-red-500/10 border border-red-500/20 rounded-xl animate-on-scroll">
            <p class="text-red-400 text-sm font-medium mb-2">Veuillez corriger les erreurs suivantes :</p>
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                <li class="text-red-400/80 text-sm font-light flex items-center gap-2">
                    <span class="w-1 h-1 rounded-full bg-red-500 inline-block flex-shrink-0"></span>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('inscription.store') }}" method="POST" class="animate-on-scroll space-y-8">
            @csrf

            {{-- Identité --}}
            <fieldset class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-5 md:p-8">
                <legend class="text-white font-medium text-sm mb-6 flex items-center gap-2 px-1">
                    <span class="w-5 h-5 rounded bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                        <iconify-icon icon="solar:user-linear" style="font-size: 0.8rem; color: #ef4444;"></iconify-icon>
                    </span>
                    Informations personnelles
                </legend>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="nom" class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-2">Nom <span class="text-red-500">*</span></label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required autocomplete="family-name"
                               class="w-full bg-[#050505] border border-white/10 rounded-lg px-4 py-3 text-neutral-200 text-sm placeholder-neutral-700 focus:outline-none focus:border-red-500/50 focus:ring-1 focus:ring-red-500/20 transition @error('nom') border-red-500/40 @enderror"
                               placeholder="Dupont">
                    </div>
                    <div>
                        <label for="prenom" class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-2">Prénom <span class="text-red-500">*</span></label>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required autocomplete="given-name"
                               class="w-full bg-[#050505] border border-white/10 rounded-lg px-4 py-3 text-neutral-200 text-sm placeholder-neutral-700 focus:outline-none focus:border-red-500/50 focus:ring-1 focus:ring-red-500/20 transition @error('prenom') border-red-500/40 @enderror"
                               placeholder="Jean">
                    </div>
                    <div>
                        <label for="email" class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-2">E-mail <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               class="w-full bg-[#050505] border border-white/10 rounded-lg px-4 py-3 text-neutral-200 text-sm placeholder-neutral-700 focus:outline-none focus:border-red-500/50 focus:ring-1 focus:ring-red-500/20 transition @error('email') border-red-500/40 @enderror"
                               placeholder="jean.dupont@email.fr">
                    </div>
                    <div>
                        <label for="telephone" class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-2">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" autocomplete="tel"
                               class="w-full bg-[#050505] border border-white/10 rounded-lg px-4 py-3 text-neutral-200 text-sm placeholder-neutral-700 focus:outline-none focus:border-red-500/50 focus:ring-1 focus:ring-red-500/20 transition"
                               placeholder="06 12 34 56 78">
                    </div>
                    <div>
                        <label for="date_naissance" class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-2">Date de naissance</label>
                        <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}"
                               class="w-full bg-[#050505] border border-white/10 rounded-lg px-4 py-3 text-neutral-200 text-sm placeholder-neutral-700 focus:outline-none focus:border-red-500/50 focus:ring-1 focus:ring-red-500/20 transition">
                    </div>
                </div>
            </fieldset>

            {{-- Pratique --}}
            <fieldset class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-5 md:p-8">
                <legend class="text-white font-medium text-sm mb-6 flex items-center gap-2 px-1">
                    <span class="w-5 h-5 rounded bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                        <iconify-icon icon="solar:medal-ribbon-linear" style="font-size: 0.8rem; color: #ef4444;"></iconify-icon>
                    </span>
                    Pratique sportive
                </legend>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-3">Discipline souhaitée <span class="text-red-500">*</span></label>
                        <div class="space-y-2.5">
                            @foreach(['jjb' => 'Jiu-Jitsu Brésilien', 'kosen_judo' => 'Kosen Judo', 'luta_livre' => 'Luta Livre', 'indifferent' => 'Peu importe'] as $val => $label)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="discipline" value="{{ $val }}" {{ old('discipline', 'indifferent') === $val ? 'checked' : '' }}
                                       class="w-4 h-4 accent-red-500">
                                <span class="text-sm text-neutral-400 group-hover:text-neutral-200 transition">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-3">Niveau <span class="text-red-500">*</span></label>
                        <div class="space-y-2.5">
                            @foreach(['debutant' => 'Débutant(e)', 'intermediaire' => 'Intermédiaire', 'avance' => 'Avancé(e)'] as $val => $label)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="niveau" value="{{ $val }}" {{ old('niveau', 'debutant') === $val ? 'checked' : '' }}
                                       class="w-4 h-4 accent-red-500">
                                <span class="text-sm text-neutral-400 group-hover:text-neutral-200 transition">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="message" class="block text-xs text-neutral-500 font-medium uppercase tracking-wider mb-2">Message / questions (optionnel)</label>
                    <textarea id="message" name="message" rows="4"
                              class="w-full bg-[#050505] border border-white/10 rounded-lg px-4 py-3 text-neutral-200 text-sm placeholder-neutral-700 focus:outline-none focus:border-red-500/50 focus:ring-1 focus:ring-red-500/20 transition resize-none"
                              placeholder="Parlez-nous de votre parcours, de vos objectifs ou posez-nous vos questions…">{{ old('message') }}</textarea>
                </div>
            </fieldset>

            {{-- Accord --}}
            <div class="flex flex-col gap-6">
                <label class="flex items-start gap-4 cursor-pointer group">
                    <input type="checkbox" name="accord_reglement" value="1" {{ old('accord_reglement') ? 'checked' : '' }}
                           class="mt-0.5 w-4 h-4 accent-red-500 flex-shrink-0 @error('accord_reglement') ring-1 ring-red-500 @enderror">
                    <span class="text-sm text-neutral-400 font-light leading-relaxed group-hover:text-neutral-300 transition">
                        J'ai pris connaissance du
                        <a href="https://cfjjb.com/docs/reglement_CFJJB_v5.2_2021.pdf" target="_blank" rel="noopener" class="text-red-400 hover:text-red-300 underline underline-offset-2 transition">règlement de la CFJJB</a>
                        et j'accepte les conditions d'adhésion à la Go Akadémi. <span class="text-red-500">*</span>
                    </span>
                </label>

                <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between pt-4 border-t border-white/5">
                    <p class="text-xs text-neutral-600 font-light">
                        <span class="text-red-500">*</span> Champs obligatoires
                    </p>
                    <button type="submit" class="group relative px-8 py-3.5 bg-white text-black rounded-full font-medium tracking-tight overflow-hidden transition-all hover:scale-[1.02] hover:bg-neutral-100 flex items-center gap-2 text-sm">
                        Envoyer ma demande
                        <iconify-icon icon="solar:arrow-right-linear" style="font-size: 1rem;"></iconify-icon>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
