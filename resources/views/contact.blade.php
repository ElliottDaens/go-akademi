@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    {{-- Hero --}}
    <section class="hero-secondary relative overflow-hidden flex items-center justify-center">
        <img src="{{ $heroImage }}" alt="Contact" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="eager">
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050505]/50 to-[#050505]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-red-600/8 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="relative text-center px-6 pt-20">
            <h1 class="text-4xl md:text-6xl font-normal tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-400">CONTACT</h1>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-5 md:px-6 py-14 md:py-20">
        @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm font-medium flex items-center gap-3">
            <iconify-icon icon="solar:check-circle-linear" style="font-size: 1.25rem; flex-shrink:0;"></iconify-icon>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid gap-10 lg:gap-16 lg:grid-cols-2">
            {{-- Info --}}
            <div class="animate-on-scroll">
                <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">Coordonnées</span>
                <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-8">Des questions ?</h2>

                <div class="space-y-4">
                    <div class="p-5 bg-[#0a0a0a] border border-white/5 rounded-xl flex items-center gap-4">
                        <div class="text-red-500 bg-red-500/10 border border-red-500/20 w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                            <iconify-icon icon="solar:map-point-linear" style="font-size: 1.25rem;"></iconify-icon>
                        </div>
                        <span class="text-neutral-300 font-medium">{{ $adresse }}</span>
                    </div>
                    <a href="tel:{{ preg_replace('/\s/', '', $telephone) }}" class="p-5 bg-[#0a0a0a] border border-white/5 rounded-xl flex items-center gap-4 hover:bg-neutral-900/50 transition group">
                        <div class="text-red-500 bg-red-500/10 border border-red-500/20 w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                            <iconify-icon icon="solar:phone-calling-linear" style="font-size: 1.25rem;"></iconify-icon>
                        </div>
                        <span class="text-neutral-300 font-medium group-hover:text-white transition">{{ $telephone }}</span>
                    </a>
                    <a href="mailto:{{ $email }}" class="p-5 bg-[#0a0a0a] border border-white/5 rounded-xl flex items-center gap-4 hover:bg-neutral-900/50 transition group">
                        <div class="text-red-500 bg-red-500/10 border border-red-500/20 w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                            <iconify-icon icon="solar:letter-linear" style="font-size: 1.25rem;"></iconify-icon>
                        </div>
                        <span class="text-neutral-300 font-medium group-hover:text-white transition">{{ $email }}</span>
                    </a>
                </div>
            </div>

            {{-- Form --}}
            <div class="animate-on-scroll animate-delay-2">
                <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">Formulaire</span>
                <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-8">Écrivez-nous</h2>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="nom" class="block text-sm font-medium text-neutral-300 mb-2">Votre nom *</label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                            class="w-full rounded-lg border border-white/10 bg-[#0a0a0a] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 placeholder-neutral-600"
                            placeholder="Jean Dupont">
                        @error('nom')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-300 mb-2">Votre email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-lg border border-white/10 bg-[#0a0a0a] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 placeholder-neutral-600"
                            placeholder="jean@exemple.fr">
                        @error('email')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="sujet" class="block text-sm font-medium text-neutral-300 mb-2">Sujet</label>
                        <input type="text" id="sujet" name="sujet" value="{{ old('sujet') }}"
                            class="w-full rounded-lg border border-white/10 bg-[#0a0a0a] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 placeholder-neutral-600"
                            placeholder="Renseignements inscription">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-neutral-300 mb-2">Votre demande *</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full rounded-lg border border-white/10 bg-[#0a0a0a] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 placeholder-neutral-600 resize-y"
                            placeholder="Votre message...">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-white text-black rounded-full font-medium tracking-tight text-sm hover:bg-neutral-200 transition-colors">
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
