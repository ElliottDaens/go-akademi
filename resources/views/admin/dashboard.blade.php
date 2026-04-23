@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-10">
        <h1 class="text-2xl md:text-3xl font-medium text-white tracking-tight">Dashboard</h1>
        <p class="mt-1 text-sm text-neutral-500">Gérez l'ensemble du contenu de votre site Go Akadémi</p>
    </div>

    {{-- Quick Stats --}}
    @php
        $stats = [
            ['label' => 'Articles', 'count' => \App\Models\Article::count(), 'icon' => 'solar:document-text-linear', 'table' => 'articles'],
            ['label' => 'Encadrants', 'count' => \App\Models\Encadrant::count(), 'icon' => 'solar:users-group-rounded-linear', 'table' => 'encadrants'],
            ['label' => 'Messages', 'count' => \App\Models\ContactMessage::where('lu', false)->count(), 'icon' => 'solar:letter-linear', 'table' => 'contact_messages', 'suffix' => ' non lus'],
            ['label' => 'Inscriptions', 'count' => \App\Models\Inscription::where('traitee', false)->count(), 'icon' => 'solar:user-plus-linear', 'table' => 'inscriptions', 'suffix' => ' en attente'],
        ];
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        @foreach($stats as $stat)
        <a href="{{ route('admin.table.index', $stat['table']) }}" class="p-5 bg-[#0a0a0a] border border-white/5 rounded-xl hover:border-red-500/20 transition group">
            <div class="flex items-center justify-between mb-3">
                <iconify-icon icon="{{ $stat['icon'] }}" style="font-size: 1.25rem; color: #ef4444;"></iconify-icon>
                <iconify-icon icon="solar:arrow-right-up-linear" style="font-size: 0.875rem; color: #525252;" class="group-hover:text-red-400 transition"></iconify-icon>
            </div>
            <div class="text-2xl font-medium text-white">{{ $stat['count'] }}</div>
            <div class="text-xs text-neutral-500 mt-1">{{ $stat['label'] }}{{ $stat['suffix'] ?? '' }}</div>
        </a>
        @endforeach
    </div>

    {{-- Activité récente : messages + inscriptions --}}
    @php
        $recentMessages = \App\Models\ContactMessage::latest()->take(4)->get();
        $recentInscriptions = \App\Models\Inscription::latest()->take(4)->get();
    @endphp
    <div class="grid gap-6 lg:grid-cols-2 mb-10">

        {{-- Derniers messages --}}
        <div class="bg-[#0a0a0a] border border-white/5 rounded-xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-white/5">
                <div class="flex items-center gap-2">
                    <iconify-icon icon="solar:letter-linear" style="font-size: 1rem; color: #ef4444;"></iconify-icon>
                    <h2 class="text-sm font-medium text-white">Derniers messages</h2>
                </div>
                <a href="{{ route('admin.table.index', 'contact_messages') }}" class="text-xs text-neutral-500 hover:text-red-400 transition">Voir tout →</a>
            </div>
            @if($recentMessages->count())
            <div class="divide-y divide-white/5">
                @foreach($recentMessages as $msg)
                <div class="px-6 py-4 flex items-start gap-4 hover:bg-white/2 transition">
                    <div class="w-8 h-8 rounded-full bg-neutral-900 border border-white/10 flex items-center justify-center text-xs text-neutral-400 font-medium flex-shrink-0">
                        {{ mb_substr($msg->nom, 0, 1) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="text-sm text-neutral-200 font-medium truncate">{{ $msg->nom }}</span>
                            @if(!$msg->lu)
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 flex-shrink-0"></span>
                            @endif
                        </div>
                        <p class="text-xs text-neutral-500 truncate">{{ $msg->sujet }}</p>
                        <p class="text-xs text-neutral-600 mt-0.5">{{ $msg->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-6 py-10 text-center text-neutral-600 text-sm">Aucun message.</div>
            @endif
        </div>

        {{-- Dernières inscriptions --}}
        <div class="bg-[#0a0a0a] border border-white/5 rounded-xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-white/5">
                <div class="flex items-center gap-2">
                    <iconify-icon icon="solar:user-plus-linear" style="font-size: 1rem; color: #ef4444;"></iconify-icon>
                    <h2 class="text-sm font-medium text-white">Dernières inscriptions</h2>
                </div>
                <a href="{{ route('admin.table.index', 'inscriptions') }}" class="text-xs text-neutral-500 hover:text-red-400 transition">Voir tout →</a>
            </div>
            @if($recentInscriptions->count())
            <div class="divide-y divide-white/5">
                @foreach($recentInscriptions as $ins)
                <div class="px-6 py-4 flex items-start gap-4 hover:bg-white/2 transition">
                    <div class="w-8 h-8 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center text-xs text-red-400 font-medium flex-shrink-0">
                        {{ mb_substr($ins->prenom, 0, 1) }}{{ mb_substr($ins->nom, 0, 1) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="text-sm text-neutral-200 font-medium">{{ $ins->prenom }} {{ $ins->nom }}</span>
                            @if(!$ins->traitee)
                            <span class="inline-flex px-1.5 py-0.5 text-[10px] font-medium bg-amber-500/10 text-amber-400 rounded-full">En attente</span>
                            @endif
                        </div>
                        <p class="text-xs text-neutral-500">{{ $ins->discipline_label }} · {{ $ins->niveau_label }}</p>
                        <p class="text-xs text-neutral-600 mt-0.5">{{ $ins->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-6 py-10 text-center text-neutral-600 text-sm">Aucune inscription pour le moment.</div>
            @endif
        </div>
    </div>

    {{-- Graphique messages par mois --}}
    @php
        $messagesParMois = \App\Models\ContactMessage::selectRaw("strftime('%Y-%m', created_at) as mois, count(*) as total")
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
        $inscriptionsParMois = \App\Models\Inscription::selectRaw("strftime('%Y-%m', created_at) as mois, count(*) as total")
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
    @endphp
    <div class="bg-[#0a0a0a] border border-white/5 rounded-xl p-6 mb-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-sm font-medium text-white">Activité des 6 derniers mois</h2>
                <p class="text-xs text-neutral-500 mt-0.5">Messages reçus et inscriptions soumises</p>
            </div>
            <div class="flex items-center gap-4 text-xs text-neutral-500">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span> Messages</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-neutral-600 inline-block"></span> Inscriptions</span>
            </div>
        </div>
        <canvas id="activity-chart" height="80"></canvas>
    </div>

    {{-- Page Editor --}}
    <div class="mb-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-medium text-white tracking-tight">Éditeur de pages</h2>
                <p class="text-sm text-neutral-500 mt-0.5">Modifiez le contenu de chaque page comme un CMS</p>
            </div>
            <a href="{{ route('admin.pages.index') }}" class="text-sm text-neutral-400 hover:text-red-400 transition inline-flex items-center gap-1">
                Voir tout
                <iconify-icon icon="solar:arrow-right-linear" style="font-size: 0.875rem;"></iconify-icon>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach(config('admin.pages') as $page => $pConfig)
            <a href="{{ route('admin.pages.edit', $page) }}" class="p-4 bg-[#0a0a0a] border border-white/5 rounded-xl hover:border-red-500/20 transition group flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-red-500/10 transition">
                    <iconify-icon icon="{{ $pConfig['icon'] ?? 'solar:document-linear' }}" style="font-size: 1rem; color: #a3a3a3;" class="group-hover:text-red-400 transition"></iconify-icon>
                </div>
                <span class="text-sm text-neutral-300 font-medium group-hover:text-white transition truncate">{{ $pConfig['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Data Tables --}}
    <div>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-medium text-white tracking-tight">Gestion des données</h2>
                <p class="text-sm text-neutral-500 mt-0.5">Tableaux CRUD pour toutes les entités</p>
            </div>
        </div>
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach(config('admin.tables') as $table => $tConfig)
            <a href="{{ route('admin.table.index', $table) }}" class="admin-card group flex items-center gap-4 p-5">
                <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-red-500/10 transition">
                    <iconify-icon icon="{{ $tConfig['icon'] ?? 'solar:document-linear' }}" style="font-size: 1.1rem; color: #a3a3a3;" class="group-hover:text-red-400 transition"></iconify-icon>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="block text-sm font-medium text-neutral-200 group-hover:text-white transition">{{ $tConfig['label'] }}</span>
                    <span class="block text-xs text-neutral-600 mt-0.5">Gérer les enregistrements</span>
                </div>
                <iconify-icon icon="solar:arrow-right-linear" style="font-size: 1rem; color: #404040;" class="group-hover:text-red-400 transition shrink-0"></iconify-icon>
            </a>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    const msgData = @json($messagesParMois->pluck('total', 'mois'));
    const insData = @json($inscriptionsParMois->pluck('total', 'mois'));

    // Build last 6 months labels
    const labels = [];
    const now = new Date();
    for (let i = 5; i >= 0; i--) {
        const d = new Date(now.getFullYear(), now.getMonth() - i, 1);
        const key = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0');
        labels.push(key);
    }

    const msgValues = labels.map(l => msgData[l] ?? 0);
    const insValues = labels.map(l => insData[l] ?? 0);
    const labelsFr = labels.map(l => {
        const [y, m] = l.split('-');
        const monthNames = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];
        return monthNames[parseInt(m, 10) - 1] + ' ' + y;
    });

    const ctx = document.getElementById('activity-chart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsFr,
            datasets: [
                {
                    label: 'Messages',
                    data: msgValues,
                    backgroundColor: 'rgba(239, 68, 68, 0.7)',
                    borderRadius: 4,
                    borderSkipped: false,
                },
                {
                    label: 'Inscriptions',
                    data: insValues,
                    backgroundColor: 'rgba(82, 82, 82, 0.6)',
                    borderRadius: 4,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111',
                    borderColor: 'rgba(255,255,255,0.1)',
                    borderWidth: 1,
                    titleColor: '#d4d4d4',
                    bodyColor: '#737373',
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    ticks: { color: '#525252', font: { size: 11 } },
                    border: { display: false }
                },
                y: {
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    ticks: { color: '#525252', font: { size: 11 }, stepSize: 1 },
                    border: { display: false },
                    beginAtZero: true,
                }
            }
        }
    });
})();
</script>
@endpush
