@extends('admin.layout')

@section('title', $label)

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-neutral-500 hover:text-red-400 transition inline-flex items-center gap-1 mb-2">
                <iconify-icon icon="solar:arrow-left-linear" style="font-size: 0.875rem;"></iconify-icon>
                Dashboard
            </a>
            <h1 class="text-2xl font-medium text-white tracking-tight">{{ $label }}</h1>
            <p class="mt-1 text-sm text-neutral-500">{{ $items->count() }} enregistrement(s)</p>
        </div>
        <a href="{{ route('admin.table.create', $table) }}" class="admin-btn-primary">
            <iconify-icon icon="solar:add-circle-linear" style="font-size: 1rem;"></iconify-icon>
            Nouveau
        </a>
    </div>

    @if($items->isEmpty())
        <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl flex flex-col items-center justify-center p-16 text-center">
            <iconify-icon icon="solar:document-text-linear" style="font-size: 3rem; color: #262626;"></iconify-icon>
            <p class="text-neutral-500 mt-4 mb-6">Aucun enregistrement pour le moment.</p>
            <a href="{{ route('admin.table.create', $table) }}" class="admin-btn-primary">Créer le premier</a>
        </div>
    @else
        <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-white/5">
                        <tr>
                            <th class="px-5 py-4 text-left text-xs font-medium uppercase tracking-wider text-neutral-600">#</th>
                            @foreach($columns as $col)
                            <th class="px-5 py-4 text-left text-xs font-medium uppercase tracking-wider text-neutral-500">{{ ucfirst(str_replace('_', ' ', $col)) }}</th>
                            @endforeach
                            <th class="px-5 py-4 text-right text-xs font-medium uppercase tracking-wider text-neutral-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($items as $item)
                        <tr class="transition hover:bg-white/[0.02]">
                            <td class="px-5 py-4 text-sm font-medium text-neutral-600">{{ $item->getKey() }}</td>
                            @foreach($columns as $col)
                            <td class="max-w-[220px] px-5 py-4 text-sm text-neutral-400">
                                @if($col === 'publie' || $col === 'lu')
                                    <span class="admin-badge {{ $item->$col ? 'bg-green-500/10 text-green-400' : 'bg-neutral-800 text-neutral-500' }}">
                                        {{ $item->$col ? 'Oui' : 'Non' }}
                                    </span>
                                @elseif($col === 'date_publication' || $col === 'created_at' || $col === 'updated_at')
                                    {{ $item->$col?->format('d/m/Y') ?? '-' }}
                                @else
                                    <span class="truncate block" title="{{ $item->$col ?? '-' }}">{{ Str::limit($item->$col ?? '-', 45) }}</span>
                                @endif
                            </td>
                            @endforeach
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.table.edit', [$table, $item->getKey()]) }}"
                                        class="rounded-lg px-3 py-1.5 text-sm font-medium text-neutral-400 transition hover:bg-white/5 hover:text-white">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.table.destroy', [$table, $item->getKey()]) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Supprimer cet enregistrement ?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="rounded-lg px-3 py-1.5 text-sm font-medium text-red-400/70 transition hover:bg-red-500/10 hover:text-red-400">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
