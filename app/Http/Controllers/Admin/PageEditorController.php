<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageEditorController extends Controller
{
    public function index()
    {
        $pages = config('admin.pages', []);

        return view('admin.pages-index', compact('pages'));
    }

    public function edit(string $page)
    {
        $pageConfig = config("admin.pages.{$page}");
        if (! $pageConfig) {
            abort(404);
        }

        $settings = [];
        foreach ($pageConfig['settings'] as $key => $meta) {
            $settings[$key] = [
                'label' => $meta['label'],
                'type' => $meta['type'],
                'value' => SiteSetting::get($key, ''),
            ];
        }

        $images = [];
        foreach ($pageConfig['images'] ?? [] as $imageKey) {
            $img = Image::where('cle', $imageKey)->first();
            $images[$imageKey] = $img;
        }

        return view('admin.page-editor', [
            'page' => $page,
            'pageLabel' => $pageConfig['label'],
            'pageIcon' => $pageConfig['icon'] ?? 'solar:document-linear',
            'settings' => $settings,
            'images' => $images,
        ]);
    }

    public function update(Request $request, string $page)
    {
        $pageConfig = config("admin.pages.{$page}");
        if (! $pageConfig) {
            abort(404);
        }

        foreach ($pageConfig['settings'] as $key => $meta) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        foreach ($pageConfig['images'] ?? [] as $imageKey) {
            $croppedData = $request->input("image_{$imageKey}_cropped");
            $filename = null;

            if ($croppedData && str_starts_with($croppedData, 'data:image/')) {
                $filename = $this->saveCroppedImage($croppedData, $imageKey);
            } elseif ($request->hasFile("image_{$imageKey}")) {
                $file = $request->file("image_{$imageKey}");
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $imageKey . '-' . now()->timestamp . '.' . $extension;
                    $file->move(public_path('images'), $filename);
                }
            }

            if ($filename) {
                $img = Image::where('cle', $imageKey)->first();
                if ($img) {
                    $img->update(['fichier' => $filename]);
                } else {
                    Image::create([
                        'cle' => $imageKey,
                        'fichier' => $filename,
                        'alt' => $pageConfig['label'],
                        'taille_recommandee' => '1920x1080',
                    ]);
                }
            }
        }

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Contenu de la page mis à jour.');
    }

    private function saveCroppedImage(string $base64Data, string $key): string
    {
        $data = explode(',', $base64Data, 2);
        $mime = str_replace(['data:', ';base64'], '', $data[0]);
        $extension = match ($mime) {
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            default => 'jpg',
        };

        $filename = $key . '-' . now()->timestamp . '-' . Str::random(4) . '.' . $extension;
        $decoded = base64_decode($data[1]);
        file_put_contents(public_path('images/' . $filename), $decoded);

        return $filename;
    }
}
