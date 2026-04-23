@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    {{-- Hero --}}
    <section class="hero-accueil relative min-h-screen flex flex-col overflow-hidden bg-[#050505]">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ $heroImage }}" alt="Go Akademi" class="hero-parallax absolute inset-0 h-full w-full object-cover opacity-20" loading="eager" style="will-change: transform; transform-origin: center;">
            <div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050505]/60 to-[#050505]"></div>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        {{-- Contenu centré --}}
        <div class="flex-1 flex items-center justify-center z-10">
            <div class="container mx-auto px-6 text-center animate-hero">
                <div class="animate-hero-item inline-flex gap-2 bg-neutral-900/50 border-neutral-800 border rounded-full mb-8 py-1.5 px-4 items-center backdrop-blur-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-600 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
                    <span class="text-xs font-medium tracking-wide text-neutral-400 uppercase">{{ $badge }}</span>
                </div>

                <h1 class="animate-hero-item text-4xl md:text-6xl lg:text-7xl font-normal tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-400 mb-8 leading-[1.1] max-w-4xl mx-auto">
                    {{ $heroTitre }} <br class="hidden md:block">
                    <span class="text-red-500 font-normal">{{ $heroTitreAccent }}</span> et la force.
                </h1>

                <p class="animate-hero-item text-base md:text-lg text-neutral-400 max-w-2xl mx-auto mb-12 font-light leading-relaxed">
                    {{ $heroSoustitre }}
                </p>

                <div class="animate-hero-item flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto px-2 sm:px-0">
                    <a href="{{ route('presentation') }}" class="group relative w-full sm:w-auto px-6 py-3 bg-white text-black rounded-full font-medium tracking-tight overflow-hidden transition-all hover:scale-[1.02] text-center">
                        <span class="relative z-10 flex items-center justify-center gap-2 text-sm">
                            Découvrir la pratique
                            <iconify-icon icon="solar:arrow-right-linear" style="font-size: 1rem;"></iconify-icon>
                        </span>
                    </a>
                    <a href="{{ route('rejoindre') }}" class="w-full sm:w-auto px-6 py-3 text-neutral-300 border border-neutral-800 rounded-full font-medium tracking-tight hover:bg-neutral-900 hover:text-white transition-all text-sm text-center">
                        Notre Philosophie
                    </a>
                </div>
            </div>
        </div>

        {{-- Disciplines strip collé en bas du hero --}}
        <div class="relative z-20 border-t border-white/5 bg-[#0a0a0a]/50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-6 py-6 flex flex-wrap justify-center md:justify-between items-center gap-8">
                <span class="text-xs font-medium tracking-[0.2em] text-neutral-600 uppercase">
                    <span id="typewriter-text" data-phrases='["Jiu-Jitsu Brésilien", "Kosen Judo", "Luta Livre", "Arts du Sol"]'></span><span class="typewriter-cursor"></span>
                </span>
                @foreach(explode('·', $disciplines) as $d)
                    <div class="text-sm font-normal uppercase tracking-widest text-neutral-400 opacity-60 hover:opacity-100 transition-opacity duration-300">{{ trim($d) }}</div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Section JJB --}}
    <section class="py-16 md:py-32 relative z-20 bg-[#050505]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-12 uppercase tracking-wider">
                <span class="text-red-500">Histoire &amp; Pratique</span>
                <span class="text-neutral-700">/</span>
                <span>Le Jiu Jitsu Brésilien</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-20 items-center mb-16 md:mb-24">
                <div class="animate-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-8 leading-tight">
                        Contrôler, soumettre, <br>
                        <span class="text-neutral-600">et se défendre.</span>
                    </h2>
                    <div class="space-y-6 text-neutral-400 leading-relaxed text-base font-light">
                        <p>{{ $introTexte ?: 'La GoAkademi vous accueille pour pratiquer les arts du combat au sol où JJB, Kosen-judo et Luta Livre se rejoignent.' }}</p>
                    </div>
                    <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-6 border-t border-white/5 pt-8">
                        <div>
                            <div class="stat-number" data-count="1917" data-count-suffix="">1917</div>
                            <div class="text-xs text-neutral-500 font-medium uppercase tracking-widest mt-1">Fondation au Brésil</div>
                        </div>
                        <div>
                            <div class="stat-number" data-count="3" data-count-suffix=" arts">3 arts</div>
                            <div class="text-xs text-neutral-500 font-medium uppercase tracking-widest mt-1">Disciplines maîtrisées</div>
                        </div>
                        <div>
                            <div class="stat-number" data-count="100" data-count-suffix="%">100%</div>
                            <div class="text-xs text-neutral-500 font-medium uppercase tracking-widest mt-1">Passion &amp; engagement</div>
                        </div>
                    </div>
                </div>

                <div class="animate-on-scroll animate-delay-2 relative group">
                    <div class="absolute -inset-px bg-gradient-to-b from-red-600/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-700"></div>
                    <div class="flex flex-col overflow-hidden transition-all duration-500 bg-[#0a0a0a] h-[400px] border border-white/5 rounded-2xl relative">
                        <img src="{{ $heroImage }}" alt="Go Akademi JJB" class="absolute inset-0 h-full w-full object-cover opacity-30 group-hover:opacity-50 transition-opacity duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/60 to-transparent"></div>
                        <div class="z-10 p-8 mt-auto">
                            <div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center mb-6">
                                <iconify-icon icon="solar:shield-warning-linear" style="font-size: 1.5rem; color: #ef4444;"></iconify-icon>
                            </div>
                            <h3 class="text-2xl font-medium text-white mb-3 tracking-tight">{{ $introTitre }}</h3>
                            <p class="text-neutral-400 text-sm max-w-sm font-light leading-relaxed">
                                Le JJB est un système de défense populaire au Brésil, aux États-Unis, au Japon et en plein essor en Europe.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4 feature cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-16">
                @php
                    $features = [
                        ['icon' => 'solar:bolt-linear', 'title' => 'Judo & Lutte', 'text' => "L'association parfaite des deux disciplines dans la phase de combat debout."],
                        ['icon' => 'solar:target-linear', 'title' => 'Contrôle au Sol', 'text' => 'Prendre une position dominante pour contrôler, soumettre ou étrangler son adversaire.'],
                        ['icon' => 'solar:users-group-rounded-linear', 'title' => 'Union des Arts', 'text' => 'Sur notre tatami, tous les genres se rejoignent pour s\'enrichir de leur spécificité.'],
                        ['icon' => 'solar:medal-ribbon-linear', 'title' => 'Sport en Essor', 'text' => 'Une discipline fondamentale et un pilier majeur du développement du MMA actuel.'],
                    ];
                @endphp
                @foreach($features as $i => $f)
                <div class="card-tilt animate-on-scroll animate-delay-{{ $i + 1 }} p-6 border border-white/5 bg-[#0a0a0a] rounded-xl hover:bg-neutral-900/50 transition duration-300 group">
                    <div class="text-red-500 mb-5 bg-red-500/10 border border-red-500/20 w-10 h-10 rounded-lg flex items-center justify-center">
                        <iconify-icon icon="{{ $f['icon'] }}" style="font-size: 1.25rem;"></iconify-icon>
                    </div>
                    <h3 class="text-white text-lg font-medium mb-2 tracking-tight">{{ $f['title'] }}</h3>
                    <p class="text-neutral-400 text-sm leading-relaxed font-light">{{ $f['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Culture & Encadrants --}}
    <section class="py-16 md:py-24 border-t border-white/5 bg-[#050505]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-10 lg:gap-16">
                <div class="lg:w-1/2 animate-on-scroll">
                    <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">La Culture GO</span>
                    <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-6">Pourquoi la Go Akadémi ?</h2>
                    <div class="space-y-6 text-neutral-400 font-light text-base leading-relaxed mb-10">
                        <p>Une vitrine très JJB, dont nous reprenons la culture et ses codes. Pourtant, cette académie sent bon le Japon : <strong class="text-neutral-200 font-medium">GO !</strong> Ce chiffre cinq, et sa symbolique bouddhique, a toutes les vertus que nous recherchons. Nombre de la perfection, il est aussi symbole d'union et de force.</p>
                        <p>C'est l'union des trois arts martiaux que nous mettons en avant au sein de nos clubs, <strong class="text-neutral-200 font-medium">l'ACJB et le KJC</strong>, où sont invités à se côtoyer et s'enrichir de leur spécificité les pratiquants de tout bord.</p>
                    </div>
                    <a href="{{ route('rejoindre') }}" class="inline-flex items-center gap-2 text-sm text-white hover:text-red-400 transition-colors">
                        Rejoindre l'Union
                        <iconify-icon icon="solar:arrow-right-linear" style="font-size: 1rem;"></iconify-icon>
                    </a>
                </div>

                <div class="lg:w-1/2">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($encadrants->take(2) as $e)
                        <div class="group animate-on-scroll animate-delay-{{ $loop->iteration }}">
                            <div class="bg-[#0a0a0a] rounded-xl aspect-[4/5] mb-4 overflow-hidden relative border border-white/5">
                                @if($e->photo)
                                    <img src="{{ asset('images/' . $e->photo) }}" alt="{{ $e->nom }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-all duration-700 grayscale group-hover:grayscale-0">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-6xl font-display text-red-500/30">
                                        {{ collect(explode(' ', $e->nom))->map(fn($p) => mb_substr($p, 0, 1))->take(2)->implode('') }}
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-transparent"></div>
                            </div>
                            <h4 class="text-white font-medium text-lg tracking-tight">{{ $e->nom }}</h4>
                            <p class="text-neutral-500 text-xs uppercase tracking-wider font-medium mt-1">
                                Complice & {{ str_replace('_', ' ', ucfirst($e->role)) }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Steps --}}
    <section class="py-20 md:py-32 bg-[#080808] relative z-20 border-t border-white/5 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-neutral-900/20 via-[#050505] to-[#050505]"></div>
        <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
            <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">STRATÉGIE DE DÉVELOPPEMENT</span>
            <h2 class="text-3xl md:text-5xl font-normal tracking-tight text-white mb-20 animate-on-scroll">
                L'intérêt des pratiquants avant tout
            </h2>

            <div class="relative flex flex-col md:flex-row justify-between items-start gap-12 md:gap-4">
                <div class="hidden md:block absolute top-[40px] left-[15%] right-[15%] h-px bg-white/10 z-0"></div>
                @php
                    $steps = [
                        ['icon' => 'solar:user-plus-linear', 'label' => 'Le Choix Libre', 'text' => "Libre à chacun de choisir son domaine d'expression sportif, que ce soit le judo, la lutte ou le JJB."],
                        ['icon' => 'solar:infinity-linear', 'label' => "L'Union des Arts", 'text' => 'Sur notre tatami, tous les genres se rejoignent. Vous êtes invités à vous côtoyer et vous enrichir.'],
                        ['icon' => 'solar:hand-stars-linear', 'label' => 'La Pratique', 'text' => "Poursuivre seul n'a plus de sens. Développez-vous dans un cadre stratégique des sports de préhension."],
                    ];
                @endphp
                @foreach($steps as $i => $step)
                <div class="relative z-10 flex flex-col items-center flex-1 animate-on-scroll animate-delay-{{ $i + 1 }}">
                    <div class="w-20 h-20 rounded-full border border-white/10 bg-[#0a0a0a] flex items-center justify-center mb-6">
                        <iconify-icon icon="{{ $step['icon'] }}" style="font-size: 1.5rem; color: #ef4444;"></iconify-icon>
                    </div>
                    <div class="text-neutral-600 font-medium text-sm mb-3 uppercase tracking-widest">Étape 0{{ $i + 1 }}</div>
                    <h3 class="text-white font-medium text-lg tracking-tight mb-3">{{ $step['label'] }}</h3>
                    <p class="text-neutral-400 text-sm font-light leading-relaxed max-w-[260px]">{{ $step['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Galerie photos --}}
    @php $galleryImages = \App\Models\Image::whereNotNull('fichier')->orderBy('created_at', 'desc')->take(9)->get(); @endphp
    @if($galleryImages->count() >= 3)
    <section class="py-24 border-t border-white/5 bg-[#050505]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 animate-on-scroll">
                <div>
                    <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">L'Académie en images</span>
                    <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white">La Go Akadémi en photos</h2>
                </div>
                <p class="text-neutral-500 text-sm font-light max-w-xs text-right hidden md:block">Cliquez sur une photo pour l'agrandir</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 auto-rows-[180px] md:auto-rows-[220px]">
                @foreach($galleryImages as $i => $img)
                @php
                    $span = match($i) {
                        0 => 'row-span-2 col-span-1',
                        3 => 'col-span-2',
                        default => ''
                    };
                @endphp
                <div class="gallery-item animate-on-scroll animate-delay-{{ min($i + 1, 4) }} {{ $span }}"
                     data-lightbox="{{ asset('images/' . $img->fichier) }}"
                     data-lightbox-alt="{{ $img->alt ?? 'Go Akadémi' }}">
                    <img src="{{ asset('images/' . $img->fichier) }}" alt="{{ $img->alt ?? 'Go Akadémi' }}" loading="lazy">
                    <div class="gallery-item-overlay">
                        <span class="text-white/60 text-xs font-medium uppercase tracking-wider">
                            <svg class="inline w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            Agrandir
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Visual divider --}}
    <div class="h-64 w-full bg-[#050505] border-t border-white/5 relative overflow-hidden flex items-center justify-center">
        <img src="{{ $ctaImage }}" alt="" class="absolute inset-0 h-full w-full object-cover opacity-10 mix-blend-luminosity grayscale" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] to-transparent"></div>
        <h2 class="text-4xl md:text-6xl font-normal tracking-tight text-white/20 uppercase z-10" style="letter-spacing: 0.1em;">
            {{ $ctaTexte }}
        </h2>
    </div>
@endsection
