@extends('layouts.app')

@section('title', 'Nous rejoindre')

@section('content')
    {{-- Hero --}}
    <section class="hero-secondary relative overflow-hidden flex items-center justify-center">
        <img src="{{ $heroImage }}" alt="Rejoignez-nous" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="eager">
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050505]/50 to-[#050505]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-red-600/8 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="relative text-center px-6 pt-20">
            <h1 class="text-4xl md:text-6xl font-normal tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-400">NOUS REJOINDRE</h1>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-5 md:px-6 py-14 md:py-20">
        {{-- Inscription --}}
        <section class="animate-on-scroll mb-16 md:mb-24">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-8 uppercase tracking-wider">
                <span class="text-red-500">Inscription</span>
                <span class="text-neutral-700">/</span>
                <span>Les modalités</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-8">Les modalités d'inscription</h2>
            <div class="space-y-6 text-neutral-400 text-base font-light leading-relaxed max-w-3xl">
                <p>{{ $inscriptionTexte1 }}</p>
                <p>{{ $inscriptionTexte2 }}</p>
                <p>{{ $inscriptionTexte3 }}</p>
            </div>
            <div class="flex flex-wrap gap-4 mt-10">
                <a href="{{ route('inscription') }}" class="px-6 py-3 bg-white text-black rounded-full font-medium tracking-tight text-sm hover:bg-neutral-200 transition-colors inline-flex items-center gap-2">
                    <iconify-icon icon="solar:user-plus-linear" style="font-size: 1rem;"></iconify-icon>
                    S'inscrire en ligne
                </a>
                <a href="https://cfjjb.com/docs/reglement_CFJJB_v5.2_2021.pdf" target="_blank" rel="noopener" class="px-6 py-3 text-neutral-300 border border-neutral-800 rounded-full font-medium tracking-tight text-sm hover:bg-neutral-900 hover:text-white transition-all">Règlement CFJJB</a>
                <a href="https://www.grappling-france.com/competition/r%C3%A8gles/" target="_blank" rel="noopener" class="px-6 py-3 text-neutral-300 border border-neutral-800 rounded-full font-medium tracking-tight text-sm hover:bg-neutral-900 hover:text-white transition-all">Règles Grappling</a>
            </div>
        </section>

        {{-- Tarifs --}}
        <section class="animate-on-scroll">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-8 uppercase tracking-wider">
                <span class="text-red-500">Tarification</span>
                <span class="text-neutral-700">/</span>
                <span>Nos tarifs</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-12">Nos tarifs</h2>
            <div class="grid gap-6 md:grid-cols-2">
                @foreach($tarifs as $tarif)
                <div class="card-tilt animate-on-scroll animate-delay-{{ min($loop->iteration, 4) }} relative group">
                    <div class="absolute -inset-px bg-gradient-to-b from-red-600/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-700"></div>
                    <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-8 relative">
                        <div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center mb-6">
                            <iconify-icon icon="solar:tag-price-linear" style="font-size: 1.5rem; color: #ef4444;"></iconify-icon>
                        </div>
                        <h3 class="text-2xl font-medium text-white mb-6 tracking-tight">{{ $tarif->label }}</h3>
                        <ul class="space-y-4 border-t border-white/5 pt-6">
                            <li class="flex justify-between text-sm"><span class="text-neutral-400 font-light">Cours d'essai</span><strong class="text-white font-medium">{{ $tarif->cours_essai }}</strong></li>
                            <li class="flex justify-between text-sm"><span class="text-neutral-400 font-light">Trimestre</span><strong class="text-neutral-200 font-medium">{{ $tarif->trimestre }}</strong></li>
                            <li class="flex justify-between text-sm"><span class="text-neutral-400 font-light">Année</span><strong class="text-neutral-200 font-medium">{{ $tarif->annee }}</strong></li>
                            @if($tarif->licence_ffjda)
                            <li class="flex justify-between text-sm"><span class="text-neutral-400 font-light">Licence FFJDA</span><strong class="text-neutral-200 font-medium">{{ $tarif->licence_ffjda }}</strong></li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- FAQ --}}
        <section class="animate-on-scroll mt-24 pt-24 border-t border-white/5">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-8 uppercase tracking-wider">
                <span class="text-red-500">Foire aux questions</span>
                <span class="text-neutral-700">/</span>
                <span>Vos questions, nos réponses</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-12">Questions fréquentes</h2>

            @php
                $faqs = [
                    ['q' => "Faut-il avoir un niveau particulier pour commencer ?", 'r' => "Non, absolument aucun niveau requis ! Nos cours débutants sont conçus pour accueillir tout le monde, quel que soit l'âge ou la condition physique. L'essentiel est la volonté d'apprendre."],
                    ['q' => "Quel équipement faut-il avoir pour le premier cours ?", 'r' => "Pour le premier cours d'essai, il vous suffit d'une tenue de sport confortable (short, t-shirt). Le kimono (gi) n'est pas obligatoire au début. Pieds nus sur le tatami, des chaussures pour vous rendre en bord de tatami."],
                    ['q' => "Y a-t-il des cours pour les enfants ?", 'r' => "Oui, nous accueillons les jeunes pratiquants. Renseignez-vous auprès de nous par téléphone ou via le formulaire de contact pour connaître les créneaux disponibles selon les âges."],
                    ['q' => "Quelle est la différence entre le JJB, le Kosen Judo et la Luta Livre ?", 'r' => "Le Jiu-Jitsu Brésilien (JJB) est axé sur le combat au sol, les soumissions et le contrôle. Le Kosen Judo est une forme de judo compétitif japonais mettant l'accent sur le ne-waza (travail au sol). La Luta Livre est un art martial brésilien permettant la lutte sans kimono. Les trois se complètent parfaitement."],
                    ['q' => "Peut-on faire un cours d'essai avant de s'inscrire ?", 'r' => "Bien sûr ! Nous proposons un cours d'essai pour vous permettre de découvrir l'ambiance et la pratique sans engagement. Consultez nos tarifs pour plus d'informations."],
                    ['q' => "Comment se déroule l'inscription officielle ?", 'r' => "Après votre essai, vous pouvez vous inscrire via la fiche d'inscription ACJB. Un certificat médical de non contre-indication à la pratique des arts martiaux est requis. Vous devrez également prendre une licence fédérale."],
                ];
            @endphp

            <div class="max-w-3xl">
                @foreach($faqs as $i => $faq)
                <div class="faq-item animate-on-scroll animate-delay-{{ min($i + 1, 4) }}">
                    <button class="faq-trigger" aria-expanded="false" aria-controls="faq-content-{{ $i }}">
                        <span class="text-base font-medium pr-6 text-left">{{ $faq['q'] }}</span>
                        <span class="faq-icon" aria-hidden="true">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M5 1v8M1 5h8"/>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-content" id="faq-content-{{ $i }}">
                        <p class="text-neutral-400 font-light text-sm leading-relaxed">{{ $faq['r'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                <p class="text-neutral-500 text-sm font-light mb-4">Vous n'avez pas trouvé votre réponse ?</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black rounded-full font-medium tracking-tight text-sm hover:bg-neutral-200 transition-colors">
                    Contactez-nous
                    <iconify-icon icon="solar:arrow-right-linear" style="font-size: 1rem;"></iconify-icon>
                </a>
            </div>
        </section>
    </div>
@endsection
