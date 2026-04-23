<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Go Akadémi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#050505] text-neutral-300 antialiased" style="font-family: 'Inter', sans-serif;">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside id="admin-sidebar" class="hidden lg:flex flex-col w-64 border-r border-white/5 bg-[#0a0a0a] fixed inset-y-0 left-0 z-40">
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/5">
                <div class="w-8 h-8 rounded-lg bg-red-500/20 flex items-center justify-center">
                    <iconify-icon icon="solar:fire-square-linear" style="font-size: 1.1rem; color: #ef4444;"></iconify-icon>
                </div>
                <span class="text-sm font-medium text-white tracking-tight">Go Akadémi <span class="text-neutral-500">Admin</span></span>
            </div>

            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                <p class="px-3 py-2 text-[10px] font-medium text-neutral-600 uppercase tracking-widest">Général</p>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/5 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                    <iconify-icon icon="solar:home-2-linear" style="font-size: 1.1rem;"></iconify-icon>
                    Dashboard
                </a>
                <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition {{ request()->routeIs('admin.pages.*') ? 'bg-white/5 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                    <iconify-icon icon="solar:document-text-linear" style="font-size: 1.1rem;"></iconify-icon>
                    Éditeur de pages
                </a>

                <p class="px-3 py-2 mt-4 text-[10px] font-medium text-neutral-600 uppercase tracking-widest">Données</p>
                @foreach(config('admin.tables') as $table => $tConfig)
                <a href="{{ route('admin.table.index', $table) }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition {{ request()->is("admin/table/{$table}*") ? 'bg-white/5 text-white' : 'text-neutral-400 hover:bg-white/5 hover:text-white' }}">
                    <iconify-icon icon="{{ $tConfig['icon'] ?? 'solar:document-linear' }}" style="font-size: 1.1rem;"></iconify-icon>
                    {{ $tConfig['label'] }}
                </a>
                @endforeach
            </nav>

            <div class="border-t border-white/5 px-3 py-4 space-y-1">
                <a href="{{ route('accueil') }}" target="_blank" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-neutral-400 hover:bg-white/5 hover:text-white transition">
                    <iconify-icon icon="solar:eye-linear" style="font-size: 1.1rem;"></iconify-icon>
                    Voir le site
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-neutral-400 hover:bg-red-500/10 hover:text-red-400 transition">
                        <iconify-icon icon="solar:logout-2-linear" style="font-size: 1.1rem;"></iconify-icon>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex-1 lg:ml-64">
            {{-- Top bar mobile --}}
            <header class="lg:hidden sticky top-0 z-30 flex items-center justify-between h-14 px-4 border-b border-white/5 bg-[#050505]/90 backdrop-blur-md">
                <button type="button" onclick="document.getElementById('admin-sidebar').classList.toggle('hidden');document.getElementById('admin-sidebar').classList.toggle('flex');" class="text-neutral-400 hover:text-white transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
                <span class="text-sm font-medium text-white">Admin</span>
                <a href="{{ route('accueil') }}" target="_blank" class="text-neutral-400 hover:text-white transition">
                    <iconify-icon icon="solar:eye-linear" style="font-size: 1.1rem;"></iconify-icon>
                </a>
            </header>

            <main class="p-6 md:p-8 lg:p-10">
                @if(session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-green-400 text-sm">
                    <iconify-icon icon="solar:check-circle-linear" style="font-size: 1.25rem;"></iconify-icon>
                    {{ session('success') }}
                </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
