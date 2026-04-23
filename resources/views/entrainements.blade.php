@extends('layouts.app')

@section('title', 'Nos entraînements')

@section('content')
    {{-- Hero --}}
    <section class="hero-secondary relative overflow-hidden flex items-center justify-center">
        <img src="{{ $heroImage }}" alt="Entraînements" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="eager">
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050505]/50 to-[#050505]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-red-600/8 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="relative text-center px-6 pt-20">
            <h1 class="text-4xl md:text-6xl font-normal tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-400">NOS ENTRAÎNEMENTS</h1>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-5 md:px-6 py-14 md:py-20">
        <p class="animate-on-scroll text-center text-base md:text-lg text-neutral-400 font-light max-w-3xl mx-auto mb-14 md:mb-20">{{ $intro }}</p>

        {{-- Horaires --}}
        <section class="animate-on-scroll mb-16 md:mb-24">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-8 uppercase tracking-wider">
                <span class="text-red-500">Planning</span>
                <span class="text-neutral-700">/</span>
                <span>Les horaires</span>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                @foreach($horaires as $h)
                <div class="animate-on-scroll animate-delay-{{ min($loop->iteration, 4) }} p-6 border border-white/5 bg-[#0a0a0a] rounded-xl hover:bg-neutral-900/50 transition duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="text-red-500 bg-red-500/10 border border-red-500/20 w-10 h-10 rounded-lg flex items-center justify-center shrink-0">
                            <iconify-icon icon="solar:clock-circle-linear" style="font-size: 1.25rem;"></iconify-icon>
                        </div>
                        <div>
                            <h3 class="text-white font-medium text-lg tracking-tight">{{ $h->label }}</h3>
                            <p class="text-neutral-400 text-sm font-light mt-1">{{ $h->jour }} · {{ $h->heure_debut }} – {{ $h->heure_fin }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Lieux --}}
        <section class="animate-on-scroll mb-16 md:mb-24">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-8 uppercase tracking-wider">
                <span class="text-red-500">Localisation</span>
                <span class="text-neutral-700">/</span>
                <span>Nos lieux d'entraînement</span>
            </div>
            <div class="grid gap-6 lg:grid-cols-2">
                @foreach($lieux as $i => $lieu)
                <div class="animate-on-scroll animate-delay-{{ min($loop->iteration, 4) }} card-tilt border border-white/5 bg-[#0a0a0a] rounded-xl overflow-hidden group hover:border-red-500/20 transition duration-300">
                    {{-- Map embed (sans clé API) --}}
                    @php
                        $adresseMap = isset($lieu->adresse) && $lieu->adresse
                            ? $lieu->adresse
                            : $lieu->nom . ', Calais, France';
                        $mapQuery = urlencode($adresseMap);
                    @endphp
                    <div class="relative h-48 bg-neutral-900 overflow-hidden map-container">
                        <iframe
                            loading="lazy"
                            class="w-full h-full map-iframe"
                            style="border:0;"
                            src="https://maps.google.com/maps?q={{ $mapQuery }}&output=embed&iwloc=&z=15"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Localisation {{ $lieu->nom }}">
                        </iframe>
                        <div class="absolute inset-0 pointer-events-none border border-white/5"></div>
                    </div>
                    <div class="p-5 md:p-6">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="text-red-500 bg-red-500/10 border border-red-500/20 w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-sm font-medium">
                                {{ $i + 1 }}
                            </div>
                            <h3 class="text-white font-medium text-lg tracking-tight">{{ $lieu->nom }}</h3>
                        </div>
                        <p class="text-neutral-400 text-sm font-light leading-relaxed mb-4">{{ $lieu->description }}</p>
                        @if(isset($lieu->adresse) && $lieu->adresse)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($lieu->adresse) }}"
                           target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 px-4 py-2.5 text-xs font-medium bg-[#111] border border-white/10 rounded-lg text-neutral-300 hover:text-white hover:border-red-500/30 transition-colors uppercase tracking-wider">
                            <iconify-icon icon="solar:map-point-linear" style="font-size: 0.9rem; color: #ef4444;"></iconify-icon>
                            Ouvrir dans Maps
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Carte générale Calais --}}
            <div class="mt-8 animate-on-scroll rounded-2xl overflow-hidden border border-white/5 h-64 relative group">
                <iframe
                    loading="lazy"
                    class="w-full h-full"
                    style="border:0; filter: invert(85%) hue-rotate(180deg) brightness(0.75) contrast(0.88);"
                    src="https://maps.google.com/maps?q=Calais,+France&output=embed&iwloc=&z=13"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Calais, France">
                </iframe>
                <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-[#0a0a0a]/40 to-transparent"></div>
                <div class="absolute bottom-4 left-4 bg-[#0a0a0a]/80 backdrop-blur-sm border border-white/10 rounded-lg px-4 py-2 text-xs text-neutral-300 font-medium">
                    <iconify-icon icon="solar:map-point-linear" class="inline text-red-500 mr-1" style="font-size: 0.9rem;"></iconify-icon>
                    Calais, Hauts-de-France
                </div>
            </div>
        </section>

        {{-- Programme --}}
        <section class="animate-on-scroll grid gap-10 lg:gap-16 lg:grid-cols-2 lg:items-center">
            <div>
                <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">Contenu</span>
                <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-8">{{ $programmeTitre }}</h2>
                <div class="space-y-6 text-neutral-400 text-base font-light leading-relaxed">
                    <p>{{ $programmeTexte1 }}</p>
                    <p>{{ $programmeTexte2 }}</p>
                    <p class="text-white font-medium">{{ $programmeTexte3 }}</p>
                </div>
            </div>
            <div class="relative group">
                <div class="absolute -inset-px bg-gradient-to-b from-red-600/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-700"></div>
                <div class="overflow-hidden bg-[#0a0a0a] border border-white/5 rounded-2xl">
                    <img src="{{ $programmeImage }}" alt="Programme" loading="lazy" class="w-full aspect-[4/3] object-cover opacity-60 group-hover:opacity-80 transition-all duration-700 grayscale group-hover:grayscale-0">
                </div>
            </div>
        </section>
    </div>
@endsection
