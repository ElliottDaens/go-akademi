<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Go Akadémi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-[#050505] p-4" style="font-family: 'Inter', sans-serif;">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-red-600/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="rounded-2xl border border-white/10 bg-[#0a0a0a] p-8 shadow-2xl">
            <div class="mb-8 flex justify-center">
                <div class="w-14 h-14 rounded-xl bg-red-500/20 flex items-center justify-center">
                    <iconify-icon icon="solar:fire-square-linear" style="font-size: 1.75rem; color: #ef4444;"></iconify-icon>
                </div>
            </div>
            <h1 class="mb-2 text-center text-2xl font-medium text-white tracking-tight">Espace Admin</h1>
            <p class="mb-8 text-center text-sm text-neutral-500">Go Akadémi — Connexion sécurisée</p>

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-400">Mot de passe</label>
                    <input type="password" id="password" name="password" required
                        class="mt-2 w-full rounded-lg border border-white/10 bg-[#050505] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 placeholder-neutral-600"
                        placeholder="••••••••" autofocus autocomplete="current-password">
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-black transition hover:bg-neutral-200">
                    <iconify-icon icon="solar:login-2-linear" style="font-size: 1.1rem;"></iconify-icon>
                    Connexion
                </button>
            </form>

            <p class="mt-8 text-center">
                <a href="{{ route('accueil') }}" class="text-sm text-neutral-500 hover:text-red-400 transition-colors inline-flex items-center gap-1">
                    <iconify-icon icon="solar:arrow-left-linear" style="font-size: 0.875rem;"></iconify-icon>
                    Retour au site
                </a>
            </p>
        </div>
    </div>
</body>
</html>
