@extends('admin.layout')

@section('title', 'Modifier — ' . $pageLabel)

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

    @php
        $previewRoutes = [
            'accueil'       => route('accueil'),
            'presentation'  => route('presentation'),
            'entrainements' => route('entrainements'),
            'rejoindre'     => route('rejoindre'),
            'actualites'    => route('actualites'),
            'contact'       => route('contact'),
            'global'        => route('accueil'),
        ];
        $previewUrl = $previewRoutes[$page] ?? route('accueil');
    @endphp

    <div class="mb-8">
        <a href="{{ route('admin.pages.index') }}" class="text-sm text-neutral-500 hover:text-red-400 transition inline-flex items-center gap-1 mb-3">
            <iconify-icon icon="solar:arrow-left-linear" style="font-size: 0.875rem;"></iconify-icon>
            Éditeur de pages
        </a>
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                    <iconify-icon icon="{{ $pageIcon }}" style="font-size: 1.25rem; color: #ef4444;"></iconify-icon>
                </div>
                <div>
                    <h1 class="text-2xl font-medium text-white tracking-tight">{{ $pageLabel }}</h1>
                    <p class="text-sm text-neutral-500">Modifiez le contenu de cette page</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" id="preview-toggle" onclick="togglePreview()"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-neutral-300 border border-white/10 rounded-lg hover:border-red-500/30 hover:text-red-400 transition bg-[#0a0a0a]">
                    <iconify-icon icon="solar:eye-linear" style="font-size: 1rem;"></iconify-icon>
                    Prévisualiser
                </button>
                <a href="{{ $previewUrl }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-neutral-300 border border-white/10 rounded-lg hover:border-red-500/30 hover:text-red-400 transition bg-[#0a0a0a]">
                    <iconify-icon icon="solar:arrow-right-up-linear" style="font-size: 1rem;"></iconify-icon>
                    Ouvrir dans un onglet
                </a>
            </div>
        </div>
    </div>

    {{-- Preview drawer --}}
    <div id="preview-drawer"
         style="position:fixed; top:0; right:-50vw; width:48vw; height:100vh; z-index:1000; transition:right 0.4s cubic-bezier(0.25,0.46,0.45,0.94); box-shadow:-8px 0 32px rgba(0,0,0,0.6);">
        <div style="position:absolute; inset:0; background:#0a0a0a; border-left:1px solid rgba(255,255,255,0.08); display:flex; flex-direction:column;">
            <div style="display:flex; align-items:center; justify-content:space-between; padding:0.75rem 1rem; border-bottom:1px solid rgba(255,255,255,0.06); flex-shrink:0;">
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <span style="width:8px;height:8px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                    <span style="font-size:0.75rem; color:#737373; font-weight:500; font-family:Inter,sans-serif;">Prévisualisation — {{ $pageLabel }}</span>
                </div>
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <button onclick="refreshPreview()" title="Rafraîchir"
                            style="width:2rem;height:2rem;border-radius:0.5rem;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);color:#a3a3a3;cursor:pointer;display:flex;align-items:center;justify-content:center; font-size:0.875rem;">
                        ↺
                    </button>
                    <button onclick="togglePreview()" title="Fermer"
                            style="width:2rem;height:2rem;border-radius:0.5rem;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);color:#a3a3a3;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                        ✕
                    </button>
                </div>
            </div>
            <iframe id="preview-iframe" src="{{ $previewUrl }}"
                    style="flex:1; border:0; width:100%;"
                    title="Prévisualisation de la page"></iframe>
        </div>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-3xl" id="page-editor-form">
        @csrf
        @method('PUT')

        {{-- Settings --}}
        @if(count($settings))
        <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            <div class="flex items-center gap-2 pb-4 border-b border-white/5">
                <iconify-icon icon="solar:pen-linear" style="font-size: 1rem; color: #ef4444;"></iconify-icon>
                <h2 class="text-white font-medium tracking-tight">Contenu texte</h2>
            </div>

            @foreach($settings as $key => $meta)
            <div>
                <label for="{{ $key }}" class="block text-sm font-medium text-neutral-300 mb-2">{{ $meta['label'] }}</label>
                @if($meta['type'] === 'textarea')
                    <textarea id="{{ $key }}" name="{{ $key }}" rows="4"
                        class="w-full rounded-lg border border-white/10 bg-[#050505] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 placeholder-neutral-600 resize-y text-sm">{{ $meta['value'] }}</textarea>
                @else
                    <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $meta['value'] }}"
                        class="w-full rounded-lg border border-white/10 bg-[#050505] px-4 py-3 text-neutral-200 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 placeholder-neutral-600 text-sm">
                @endif
            </div>
            @endforeach
        </div>
        @endif

        {{-- Images with Cropper --}}
        @if(count($images))
        <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            <div class="flex items-center gap-2 pb-4 border-b border-white/5">
                <iconify-icon icon="solar:gallery-minimalistic-linear" style="font-size: 1rem; color: #ef4444;"></iconify-icon>
                <h2 class="text-white font-medium tracking-tight">Images</h2>
                <span class="text-xs text-neutral-600 ml-2">Sélectionnez la zone à afficher après avoir choisi une image</span>
            </div>

            @foreach($images as $imageKey => $img)
            <div class="image-upload-block" data-key="{{ $imageKey }}">
                <label class="block text-sm font-medium text-neutral-300 mb-2">
                    {{ ucfirst(str_replace('_', ' ', $imageKey)) }}
                    @if($img && $img->taille_recommandee)
                        <span class="text-neutral-600 font-normal">({{ $img->taille_recommandee }})</span>
                    @endif
                </label>

                @if($img && $img->fichier)
                <div class="flex items-center gap-4 mb-3 p-3 bg-[#050505] border border-white/5 rounded-lg">
                    @if(in_array(strtolower(pathinfo($img->fichier, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif','webp']))
                        <img src="{{ asset('images/' . $img->fichier) }}" alt="" class="h-16 w-16 rounded-lg object-cover border border-white/10">
                    @endif
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-neutral-400 truncate">{{ $img->fichier }}</p>
                        <p class="text-xs text-neutral-600 mt-0.5">Choisir un nouveau fichier pour remplacer</p>
                    </div>
                </div>
                @endif

                <input type="file" accept="image/*" class="crop-file-input block w-full text-sm text-neutral-400 file:mr-4 file:rounded-lg file:border-0 file:bg-red-500/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-red-400 hover:file:bg-red-500/20 file:transition file:cursor-pointer"
                    data-key="{{ $imageKey }}">

                {{-- Cropper preview area --}}
                <div class="crop-preview mt-4 hidden" data-key="{{ $imageKey }}">
                    <div class="bg-[#050505] border border-white/5 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs text-neutral-400 flex items-center gap-1.5">
                                <iconify-icon icon="solar:crop-linear" style="font-size: 0.875rem; color: #ef4444;"></iconify-icon>
                                Déplacez et redimensionnez le cadre pour choisir la zone
                            </span>
                            <div class="flex items-center gap-2">
                                <button type="button" class="crop-rotate-btn text-xs text-neutral-400 hover:text-white transition px-2 py-1 rounded bg-white/5 hover:bg-white/10" data-key="{{ $imageKey }}">
                                    <iconify-icon icon="solar:refresh-linear" style="font-size: 0.75rem;"></iconify-icon> Pivoter
                                </button>
                                <button type="button" class="crop-reset-btn text-xs text-neutral-400 hover:text-white transition px-2 py-1 rounded bg-white/5 hover:bg-white/10" data-key="{{ $imageKey }}">
                                    <iconify-icon icon="solar:restart-linear" style="font-size: 0.75rem;"></iconify-icon> Reset
                                </button>
                            </div>
                        </div>
                        <div class="crop-container max-h-[400px] overflow-hidden rounded-lg" data-key="{{ $imageKey }}">
                            <img class="crop-image w-full" data-key="{{ $imageKey }}" style="display:block; max-width:100%;">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="image_{{ $imageKey }}_cropped" class="crop-data" data-key="{{ $imageKey }}">
            </div>
            @endforeach
        </div>
        @endif

        <div class="flex flex-wrap gap-3 pt-4">
            <button type="submit" class="admin-btn-primary px-6 py-2.5" id="save-btn">
                <iconify-icon icon="solar:check-circle-linear" style="font-size: 1rem;"></iconify-icon>
                Enregistrer les modifications
            </button>
            <a href="{{ route('admin.pages.index') }}" class="admin-btn-secondary px-6 py-2.5">Annuler</a>
        </div>
    </form>

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
                        const sizeStr = input.closest('.image-upload-block').querySelector('.text-neutral-600');
                        let ratio = NaN;
                        if (sizeStr) {
                            const match = sizeStr.textContent.match(/(\d+)x(\d+)/);
                            if (match) ratio = parseInt(match[1]) / parseInt(match[2]);
                        }

                        croppers[key] = new Cropper(img, {
                            aspectRatio: isNaN(ratio) ? NaN : ratio,
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

        document.getElementById('page-editor-form').addEventListener('submit', function(e) {
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

    <script>
    let previewOpen = false;
    const drawer = document.getElementById('preview-drawer');
    const iframe = document.getElementById('preview-iframe');
    const toggleBtn = document.getElementById('preview-toggle');

    function togglePreview() {
        previewOpen = !previewOpen;
        drawer.style.right = previewOpen ? '0' : '-50vw';
        if (toggleBtn) {
            toggleBtn.style.borderColor = previewOpen ? 'rgba(239,68,68,0.4)' : '';
            toggleBtn.style.color = previewOpen ? '#ef4444' : '';
        }
    }

    function refreshPreview() {
        if (iframe) iframe.src = iframe.src;
    }

    // After save, refresh the preview iframe
    document.getElementById('page-editor-form')?.addEventListener('submit', function () {
        if (previewOpen) {
            setTimeout(refreshPreview, 1500);
        }
    });

    // Keyboard shortcut: Ctrl+P to toggle preview
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            togglePreview();
        }
    });
    </script>
@endsection
