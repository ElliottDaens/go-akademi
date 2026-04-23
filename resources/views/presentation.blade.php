@extends('layouts.app')

@section('title', "L'Académie Calaisienne de JJB")

@section('content')
    {{-- Hero --}}
    <section class="hero-secondary relative overflow-hidden flex items-center justify-center">
        <img src="{{ $heroImage }}" alt="L'Académie" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="eager">
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050505]/50 to-[#050505]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-red-600/8 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="relative text-center px-6 pt-20">
            <div class="inline-flex gap-2 bg-neutral-900/50 border-neutral-800 border rounded-full mb-6 py-1.5 px-4 items-center backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
                <span class="text-xs font-medium tracking-wide text-neutral-400 uppercase">Histoire & Pratique</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-normal tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-400 leading-[1.1]">L'ACADÉMIE</h1>
            <p class="mt-2 text-xl text-red-400/80 font-light">Calaisienne de JJB</p>
        </div>
    </section>

    {{-- JJB Section --}}
    <section class="py-16 md:py-24 bg-[#050505]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 mb-10 uppercase tracking-wider">
                <span class="text-red-500">{{ $jjbTitre }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-20 items-center mb-16 md:mb-24">
                <div class="animate-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-8 leading-tight">
                        Contrôler, soumettre, <br>
                        <span class="text-neutral-600">{{ $jjbSoustitre }}</span>
                    </h2>
                    <div class="space-y-6 text-neutral-400 leading-relaxed text-base font-light">
                        <p>{{ $jjbTexte1 }}</p>
                        <p>{{ $jjbTexte2 }}</p>
                    </div>
                    <div class="mt-12 grid grid-cols-2 gap-8 border-t border-white/5 pt-8">
                        <div>
                            <div class="text-4xl tracking-tight text-red-500/90 mb-1 font-light">1917</div>
                            <div class="text-xs text-neutral-500 font-medium uppercase tracking-widest">Fondation au Brésil</div>
                        </div>
                        <div>
                            <div class="text-4xl tracking-tight text-red-500/90 mb-1 font-light">MMA</div>
                            <div class="text-xs text-neutral-500 font-medium uppercase tracking-widest">Essor Européen</div>
                        </div>
                    </div>
                </div>

                <div class="animate-on-scroll animate-delay-2 relative group">
                    <div class="absolute -inset-px bg-gradient-to-b from-red-600/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-700"></div>
                    <div class="overflow-hidden bg-[#0a0a0a] border border-white/5 rounded-2xl relative">
                        <img src="{{ $jjbImage }}" alt="JJB" class="w-full aspect-[4/3] object-cover opacity-60 group-hover:opacity-80 transition-all duration-700 grayscale group-hover:grayscale-0" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] to-transparent"></div>
                    </div>
                </div>
            </div>

            {{-- Essor card --}}
            <div class="animate-on-scroll relative group mb-24">
                <div class="absolute -inset-px bg-gradient-to-r from-red-600/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-700"></div>
                <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-8 md:p-12 relative">
                    <div class="w-12 h-12 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center mb-6">
                        <iconify-icon icon="solar:shield-warning-linear" style="font-size: 1.5rem; color: #ef4444;"></iconify-icon>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-medium text-white mb-4 tracking-tight">{{ $essorTitre }}</h3>
                    <p class="text-neutral-400 text-base md:text-lg font-light leading-relaxed max-w-3xl">{{ $essorTexte }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Culture & Encadrants --}}
    <section class="py-16 md:py-24 border-t border-white/5 bg-[#050505]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-20 animate-on-scroll">
                <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">La Culture GO</span>
                <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-6">{{ $cultureTitre }}</h2>
                <div class="space-y-6 text-neutral-400 font-light text-base leading-relaxed max-w-4xl">
                    <p>{{ $cultureTexte1 }}</p>
                    <p>{{ $cultureTexte2 }}</p>
                </div>
            </div>

            {{-- Encadrants --}}
            <div class="animate-on-scroll">
                <span class="text-red-500 text-xs font-medium tracking-widest uppercase mb-4 block">L'Équipe</span>
                <h2 class="text-3xl md:text-4xl font-normal tracking-tight text-white mb-12">Nos encadrants</h2>
                <p class="text-neutral-400 font-light text-base mb-12">Les cours sont encadrés par des professeurs diplômés d'état (DEJEPS).</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($encadrants as $e)
                    @php $initiales = collect(explode(' ', $e->nom))->map(fn($p) => mb_substr($p, 0, 1))->take(2)->implode(''); @endphp
                    <div class="animate-on-scroll animate-delay-{{ min($loop->iteration, 4) }} group">
                        <div class="bg-[#0a0a0a] rounded-xl border border-white/5 overflow-hidden">
                            <div class="aspect-square flex items-center justify-center {{ $loop->first ? 'bg-red-500/10' : 'bg-neutral-900' }}">
                                @if($e->photo)
                                    <img src="{{ asset('images/' . $e->photo) }}" alt="{{ $e->nom }}" class="w-full h-full object-cover opacity-70 group-hover:opacity-90 transition grayscale group-hover:grayscale-0">
                                @else
                                    <span class="text-6xl font-display {{ $loop->first ? 'text-red-500/60' : 'text-neutral-700' }}">{{ $initiales }}</span>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-white font-medium text-lg tracking-tight">{{ $e->nom }}</h3>
                                <p class="text-red-400/70 text-xs uppercase tracking-wider font-medium mt-1 mb-4">{{ str_replace('_', ' ', $e->role) }}</p>
                                <ul class="space-y-1.5 border-t border-white/5 pt-4">
                                    @foreach($e->qualifications as $q)
                                    @if($q)<li class="text-neutral-400 text-sm font-light">{{ $q }}</li>@endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('rejoindre') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black rounded-full font-medium tracking-tight text-sm hover:bg-neutral-200 transition-colors">
                    Consultez les modalités d'inscription
                    <iconify-icon icon="solar:arrow-right-linear" style="font-size: 1rem;"></iconify-icon>
                </a>
            </div>
        </div>
    </section>
@endsection
