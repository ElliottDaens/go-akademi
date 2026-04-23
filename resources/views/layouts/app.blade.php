<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Go Akademi - L'Académie Calaisienne de Jiu Jitsu Brésilien, Kosen Judo et Luta Livre">
    <title>@yield('title', 'Go Akadémi') - Jiu Jitsu Brésilien Calais</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen overflow-x-hidden antialiased" style="font-family: 'Inter', sans-serif;">
    {{-- Page Loader --}}
    <div id="page-loader" aria-hidden="true">
        <img src="{{ asset('images/Logo carré blanc.png') }}" alt="" class="loader-logo h-12 w-12 object-contain">
        <div class="loader-bar-track"><div class="loader-bar"></div></div>
    </div>

    <a href="#main-content" class="skip-link">Aller au contenu</a>

    <nav id="site-header" class="fixed top-0 w-full z-50 border-b border-white/5 bg-[#050505]/80 backdrop-blur-md transition-all duration-300">
        <div class="flex h-20 max-w-7xl mx-auto px-6 items-center justify-between">
            <a href="{{ route('accueil') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/Logo carré blanc.png') }}" alt="" class="h-8 w-8 object-contain group-hover:opacity-80 transition-opacity" width="32" height="32">
                <span class="text-lg font-medium tracking-tight text-white uppercase mt-0.5 group-hover:text-neutral-200 transition-colors">
                    Go Akadémi
                </span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-normal text-neutral-400">
                <a href="{{ route('accueil') }}" class="hover:text-red-400 transition-colors {{ request()->routeIs('accueil') ? 'text-white' : '' }}">Accueil</a>
                <a href="{{ route('presentation') }}" class="hover:text-red-400 transition-colors {{ request()->routeIs('presentation') ? 'text-white' : '' }}">L'Académie</a>
                <a href="{{ route('entrainements') }}" class="hover:text-red-400 transition-colors {{ request()->routeIs('entrainements') ? 'text-white' : '' }}">Entraînements</a>
                <a href="{{ route('rejoindre') }}" class="hover:text-red-400 transition-colors {{ request()->routeIs('rejoindre') ? 'text-white' : '' }}">Nous rejoindre</a>
                <a href="{{ route('actualites') }}" class="hover:text-red-400 transition-colors {{ request()->routeIs('actualites') ? 'text-white' : '' }}">Actualités</a>
                <a href="{{ route('contact') }}" class="hover:text-red-400 transition-colors {{ request()->routeIs('contact') ? 'text-white' : '' }}">Contact</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('rejoindre') }}" class="hidden sm:inline-flex bg-white text-black px-5 py-2 rounded-full text-xs font-medium tracking-wide hover:bg-neutral-200 transition-colors">
                    MONTER SUR LE TATAMI
                </a>
                <button type="button" id="menu-toggle" class="inline-flex h-11 w-11 items-center justify-center rounded-lg text-neutral-400 hover:text-white transition md:hidden" aria-expanded="false" aria-controls="mobile-menu" aria-label="Menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden flex-col md:hidden border-t border-white/5 bg-[#050505]/97 backdrop-blur-xl px-6 pb-6 pt-2">
            @php $navLinks = [
                ['route' => 'accueil',       'label' => 'Accueil'],
                ['route' => 'presentation',  'label' => "L'Académie"],
                ['route' => 'entrainements', 'label' => 'Entraînements'],
                ['route' => 'rejoindre',     'label' => 'Nous rejoindre'],
                ['route' => 'actualites',    'label' => 'Actualités'],
                ['route' => 'contact',       'label' => 'Contact'],
            ]; @endphp
            @foreach($navLinks as $link)
            @php $isActive = request()->routeIs($link['route']); @endphp
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 py-3 text-sm transition border-b border-white/5 last:border-0 {{ $isActive ? 'text-white font-medium' : 'text-neutral-400 hover:text-white' }}"
               {{ $isActive ? 'aria-current=page' : '' }}>
                @if($isActive)
                <span class="w-1 h-4 rounded-full bg-red-500 shrink-0"></span>
                @else
                <span class="w-1 h-4 rounded-full shrink-0"></span>
                @endif
                {{ $link['label'] }}
            </a>
            @endforeach
            <a href="{{ route('rejoindre') }}" class="mt-5 block text-center bg-white text-black px-5 py-3 rounded-full text-xs font-medium tracking-wide active:scale-[0.97] transition-transform">MONTER SUR LE TATAMI</a>
        </div>
    </nav>

    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    <footer class="border-t border-white/10 bg-[#050505] pt-20 pb-10 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ route('accueil') }}" class="flex items-center gap-3 mb-6 group">
                        <img src="{{ asset('images/Logo carré blanc.png') }}" alt="" class="h-8 w-8 object-contain" width="32" height="32">
                        <span class="text-base font-medium tracking-tight text-white uppercase mt-1">GO AKADÉMI</span>
                    </a>
                    <p class="text-neutral-500 text-sm max-w-sm mb-8 leading-relaxed font-light">
                        {{ App\Models\SiteSetting::get('footer_description', "Le Jiu Jitsu Brésilien (JJB) : art martial, système de défense personnel et sport de combat. L'union par la perfection et la force.") }}
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ App\Models\SiteSetting::get('instagram_url', '#') }}" class="inline-flex items-center justify-center w-11 h-11 rounded-lg text-neutral-500 hover:text-white hover:bg-white/5 transition-colors" aria-label="Instagram">
                            <iconify-icon icon="solar:camera-linear" style="font-size: 1.25rem;"></iconify-icon>
                        </a>
                        <a href="{{ App\Models\SiteSetting::get('youtube_url', '#') }}" class="inline-flex items-center justify-center w-11 h-11 rounded-lg text-neutral-500 hover:text-white hover:bg-white/5 transition-colors" aria-label="YouTube">
                            <iconify-icon icon="solar:play-circle-linear" style="font-size: 1.25rem;"></iconify-icon>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-medium mb-6 text-xs tracking-widest uppercase">Navigation</h4>
                    <ul class="space-y-4 text-sm text-neutral-500">
                        <li><a href="{{ route('presentation') }}" class="hover:text-red-400 transition-colors">L'Académie</a></li>
                        <li><a href="{{ route('entrainements') }}" class="hover:text-red-400 transition-colors">Entraînements</a></li>
                        <li><a href="{{ route('actualites') }}" class="hover:text-red-400 transition-colors">Actualités</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-red-400 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-medium mb-6 text-xs tracking-widest uppercase">Contact</h4>
                    <ul class="space-y-4 text-sm text-neutral-500">
                        <li><span class="text-neutral-400">{{ App\Models\SiteSetting::get('footer_adresse', '62100 Calais') }}</span></li>
                        <li><a href="tel:{{ preg_replace('/\s/', '', App\Models\SiteSetting::get('footer_telephone', '0627542416')) }}" class="hover:text-red-400 transition-colors">{{ App\Models\SiteSetting::get('footer_telephone', '06 27 54 24 16') }}</a></li>
                        <li><a href="mailto:{{ App\Models\SiteSetting::get('footer_email', 'Acjb62100@gmail.com') }}" class="hover:text-red-400 transition-colors">{{ App\Models\SiteSetting::get('footer_email', 'Acjb62100@gmail.com') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-xs text-neutral-600 font-light">
                    &copy; {{ date('Y') }} Go Akadémi. Tous droits réservés.
                    <a href="{{ route('admin.login') }}" class="ml-3 opacity-40 hover:opacity-100 transition-opacity">Admin</a>
                </div>
                <div class="text-xs text-neutral-700 font-medium tracking-[0.2em] uppercase">
                    {{ App\Models\SiteSetting::get('site_slogan', "L'Union fait la force") }}
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
