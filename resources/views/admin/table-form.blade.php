@extends('admin.layout')

@section('title', ($edit ?? false) ? 'Modifier' : 'Créer')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

    <div class="mb-8">
        <a href="{{ route('admin.table.index', $table) }}" class="text-sm text-neutral-500 hover:text-red-400 transition inline-flex items-center gap-1 mb-3">
            <iconify-icon icon="solar:arrow-left-linear" style="font-size: 0.875rem;"></iconify-icon>
            {{ $label }}
        </a>
        <h1 class="text-2xl font-medium text-white tracking-tight">
            {{ ($edit ?? false) ? 'Modifier' : 'Créer' }} — {{ $label }}
        </h1>
    </div>

    @php $hasFileUpload = !empty($file_columns ?? []); @endphp

    <form action="{{ ($edit ?? false) ? route('admin.table.update', [$table, $item->getKey()]) : route('admin.table.store', $table) }}"
        method="POST" class="max-w-2xl" id="crud-form"
        enctype="{{ $hasFileUpload ? 'multipart/form-data' : 'application/x-www-form-urlencoded' }}">
        @csrf
        @if($edit ?? false) @method('PUT') @endif

        <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            @foreach($columns as $col)
            <div>
                @php
                    $value = old($col, $item->$col ?? '');
                    $isTextarea = in_array($col, ['extrait', 'contenu', 'bio', 'description', 'message', 'valeur']);
                    $isBoolean = in_array($col, ['publie', 'lu']);
                    $isDate = in_array($col, ['date_publication']);
                    $isFile = in_array($col, $file_columns ?? []);
                @endphp
                <label for="{{ $col }}" class="block text-sm font-medium text-neutral-300 mb-2">{{ ucfirst(str_replace('_', ' ', $col)) }}</label>

                @if($isFile)
                    <div class="space-y-3 image-upload-block" data-key="{{ $col }}">
                        @if(($edit ?? false) && $value)
                            <div class="flex items-center gap-4 p-3 bg-[#050505] border border-white/5 rounded-lg">
                                @if(in_array(strtolower(pathinfo($value, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif','webp']))
                                    <img src="{{ asset('images/' . $value) }}" alt="" class="h-16 w-16 rounded-lg object-cover border border-white/10">
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs text-neutral-400 truncate">{{ $value }}</p>
                                    <p class="text-xs text-neutral-600 mt-0.5">Choisir un nouveau fichier pour remplacer</p>
                                </div>
                            </div>
                        @endif
                        <input type="file" id="{{ $col }}" name="{{ $col }}" accept="image/*"
                            class="crop-file-input block w-full text-sm text-neutral-400 file:mr-4 file:rounded-lg file:border-0 file:bg-red-500/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-red-400 hover:file:bg-red-500/20 file:transition file:cursor-pointer"
                            data-key="{{ $col }}">

                        <div class="crop-preview mt-3 hidden" data-key="{{ $col }}">
                            <div class="bg-[#050505] border border-white/5 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs text-neutral-400 flex items-center gap-1.5">
                                        <iconify-icon icon="solar:crop-linear" style="font-size: 0.875rem; color: #ef4444;"></iconify-icon>
                                        Déplacez le cadre pour choisir la zone
                                    </span>
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="crop-rotate-btn text-xs text-neutral-400 hover:text-white transition px-2 py-1 rounded bg-white/5 hover:bg-white/10" data-key="{{ $col }}">
                                            <iconify-icon icon="solar:refresh-linear" style="font-size: 0.75rem;"></iconify-icon> Pivoter
                                        </button>
                                        <button type="button" class="crop-reset-btn text-xs text-neutral-400 hover:text-white transition px-2 py-1 rounded bg-white/5 hover:bg-white/10" data-key="{{ $col }}">
                                            <iconify-icon icon="solar:restart-linear" style="font-size: 0.75rem;"></iconify-icon> Reset
                                        </button>
                                    </div>
                                </div>
                                <div class="crop-container max-h-[400px] overflow-hidden rounded-lg" data-key="{{ $col }}">
                                    <img class="crop-image w-full" data-key="{{ $col }}" style="display:block; max-width:100%;">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="{{ $col }}_cropped" class="crop-data" data-key="{{ $col }}">
                    </div>
                @elseif($isTextarea)
                    <textarea id="{{ $col }}" name="{{ $col }}" rows="4"
                        class="w-full rounded-lg border border-white/10 bg-[#050505] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 resize-y text-sm">{{ $value }}</textarea>
                @elseif($isBoolean)
                    <select id="{{ $col }}" name="{{ $col }}"
                        class="w-full rounded-lg border border-white/10 bg-[#050505] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 text-sm">
                        <option value="0" {{ !$value ? 'selected' : '' }}>Non</option>
                        <option value="1" {{ $value ? 'selected' : '' }}>Oui</option>
                    </select>
                @elseif($isDate)
                    <input type="date" id="{{ $col }}" name="{{ $col }}" value="{{ $value ? $item->$col?->format('Y-m-d') : '' }}"
                        class="w-full rounded-lg border border-white/10 bg-[#050505] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 text-sm">
                @else
                    <input type="text" id="{{ $col }}" name="{{ $col }}" value="{{ $value }}"
                        class="w-full rounded-lg border border-white/10 bg-[#050505] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 text-sm"
                        @if($col === 'slug') placeholder="Laissez vide pour générer depuis le titre" @endif>
                @endif

                @error($col)
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            @endforeach
        </div>

        <div class="flex flex-wrap gap-3 mt-6">
            <button type="submit" class="admin-btn-primary px-6 py-2.5">
                <iconify-icon icon="solar:check-circle-linear" style="font-size: 1rem;"></iconify-icon>
                {{ ($edit ?? false) ? 'Enregistrer les modifications' : 'Créer' }}
            </button>
            <a href="{{ route('admin.table.index', $table) }}" class="admin-btn-secondary px-6 py-2.5">Annuler</a>
        </div>
    </form>

    @if($hasFileUpload)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const croppers = {};

        document.querySelectorAll('.crop-file-input').forEach(function(input) {
            const key = input.dataset.key;

            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file || !file.type.startsWith('image/')) return;

                const preview = document.querySelector('.crop-preview[data-key="' + key + '"]');
                const img = document.querySelector('.crop-image[data-key="' + key + '"]');

                if (croppers[key]) {
                    croppers[key].destroy();
                    delete croppers[key];
                }

                const reader = new FileReader();
                reader.onload = function(ev) {
                    img.src = ev.target.result;
                    preview.classList.remove('hidden');

                    img.addEventListener('load', function() {
                        croppers[key] = new Cropper(img, {
                            viewMode: 1,
                            dragMode: 'move',
                            autoCropArea: 0.9,
                            responsive: true,
                            background: false,
                            guides: true,
                            highlight: true,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                        });
                    }, { once: true });
                };
                reader.readAsDataURL(file);
            });
        });

        document.querySelectorAll('.crop-rotate-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const key = btn.dataset.key;
                if (croppers[key]) croppers[key].rotate(90);
            });
        });

        document.querySelectorAll('.crop-reset-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const key = btn.dataset.key;
                if (croppers[key]) croppers[key].reset();
            });
        });

        document.getElementById('crud-form').addEventListener('submit', function(e) {
            Object.keys(croppers).forEach(function(key) {
                const cropper = croppers[key];
                if (!cropper) return;
                const canvas = cropper.getCroppedCanvas({
                    maxWidth: 1920,
                    maxHeight: 1080,
                    imageSmoothingQuality: 'high',
                });
                if (canvas) {
                    const dataUrl = canvas.toDataURL('image/jpeg', 0.92);
                    document.querySelector('.crop-data[data-key="' + key + '"]').value = dataUrl;
                }
            });
        });
    });
    </script>

    <style>
        .cropper-container { background: #111 !important; }
        .cropper-view-box { outline: 2px solid #ef4444 !important; outline-color: rgba(239,68,68,0.75) !important; }
        .cropper-line { background-color: rgba(239,68,68,0.5) !important; }
        .cropper-point { background-color: #ef4444 !important; width: 8px !important; height: 8px !important; border-radius: 50% !important; }
        .cropper-dashed { border-color: rgba(255,255,255,0.2) !important; }
        .cropper-modal { background-color: rgba(0,0,0,0.7) !important; }
    </style>
    @endif
@endsection
