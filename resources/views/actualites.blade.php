@extends('layouts.app')

@section('title', 'Actualités')

@section('content')
    {{-- Hero --}}
    <section class="hero-secondary relative overflow-hidden flex items-center justify-center">
        <img src="{{ $heroImage }}" alt="Actualités" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="eager">
        <div class="absolute inset-0 bg-gradient-to-b from-[#050505] via-[#050505]/50 to-[#050505]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-red-600/8 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="relative text-center px-6 pt-20">
            <h1 class="text-4xl md:text-6xl font-normal tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-400">ACTUALITÉS</h1>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-6 py-20">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12 animate-on-scroll">
            <div class="flex items-center gap-2 text-xs font-medium text-neutral-500 uppercase tracking-wider">
                <span class="text-red-500">News</span>
                <span class="text-neutral-700">/</span>
                <span>Toutes les actualités</span>
            </div>

            @if($articles->count() > 0)
            @php $categories = $articles->pluck('categorie')->unique()->filter()->values(); @endphp
            @if($categories->count() > 1)
            <div class="flex flex-wrap gap-2" role="group" aria-label="Filtrer par catégorie">
                <button class="filter-btn active" data-filter="all">Tout</button>
                @foreach($categories as $cat)
                <button class="filter-btn" data-filter="{{ $cat }}">{{ ucfirst($cat) }}</button>
                @endforeach
            </div>
            @endif
            @endif
        </div>

        <div class="space-y-6" id="articles-list">
            @forelse($articles as $article)
            <article class="animate-on-scroll animate-delay-{{ min($loop->iteration, 4) }} group p-6 md:p-8 bg-[#0a0a0a] border border-white/5 rounded-xl hover:bg-neutral-900/50 transition duration-300"
                     data-category="{{ $article->categorie }}">
                <div class="flex flex-wrap items-center gap-3 text-sm mb-4">
                    <time class="text-neutral-500 text-xs font-medium uppercase tracking-wider">{{ $article->date_publication->translatedFormat('d F Y') }}</time>
                    <span class="bg-red-500/10 text-red-400 px-2.5 py-0.5 rounded-full text-xs font-medium">{{ ucfirst($article->categorie) }}</span>
                </div>
                <h3 class="text-xl md:text-2xl font-medium text-white tracking-tight group-hover:text-red-400 transition-colors">{{ $article->titre }}</h3>
                <p class="mt-4 text-neutral-400 font-light leading-relaxed">{{ $article->extrait }}</p>
            </article>
            @empty
            <div class="text-center py-20">
                <iconify-icon icon="solar:document-text-linear" style="font-size: 3rem; color: #404040;"></iconify-icon>
                <p class="text-neutral-500 mt-4">Aucune actualité pour le moment.</p>
            </div>
            @endforelse
        </div>
    </div>
@endsection
