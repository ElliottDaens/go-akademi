@extends('admin.layout')

@section('title', 'Éditeur de pages')

@section('content')
    <div class="mb-10">
        <h1 class="text-2xl md:text-3xl font-medium text-white tracking-tight">Éditeur de pages</h1>
        <p class="mt-1 text-sm text-neutral-500">Modifiez le contenu de chaque page de votre site, comme dans un CMS</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($pages as $page => $pConfig)
        <a href="{{ route('admin.pages.edit', $page) }}" class="group relative overflow-hidden">
            <div class="absolute -inset-px bg-gradient-to-b from-red-600/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="relative p-6 bg-[#0a0a0a] border border-white/5 rounded-2xl hover:bg-neutral-900/30 transition">
                <div class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center mb-5 group-hover:bg-red-500/10 transition">
                    <iconify-icon icon="{{ $pConfig['icon'] ?? 'solar:document-linear' }}" style="font-size: 1.5rem; color: #a3a3a3;" class="group-hover:text-red-400 transition"></iconify-icon>
                </div>
                <h3 class="text-white font-medium text-lg tracking-tight mb-2 group-hover:text-red-400 transition">{{ $pConfig['label'] }}</h3>
                <p class="text-neutral-500 text-sm font-light">
                    {{ count($pConfig['settings'] ?? []) }} paramètre(s) · {{ count($pConfig['images'] ?? []) }} image(s)
                </p>
                <div class="mt-4 flex items-center gap-1 text-xs text-neutral-600 group-hover:text-red-400 transition">
                    <span>Modifier</span>
                    <iconify-icon icon="solar:arrow-right-linear" style="font-size: 0.75rem;"></iconify-icon>
                </div>
            </div>
        </a>
        @endforeach
    </div>
@endsection
