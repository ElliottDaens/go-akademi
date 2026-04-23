<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrudController extends Controller
{
    public function index(string $table)
    {
        $config = $this->getConfig($table);
        $model = new $config['model'];
        $items = $model->orderBy($model->getKeyName())->get();

        return view('admin.table-index', [
            'table' => $table,
            'label' => $config['label'],
            'items' => $items,
            'columns' => $config['columns'],
        ]);
    }

    public function create(string $table)
    {
        $config = $this->getConfig($table);
        $model = new $config['model'];

        return view('admin.table-form', [
            'table' => $table,
            'label' => $config['label'],
            'item' => $model,
            'columns' => $config['columns'],
            'file_columns' => $config['file_columns'] ?? [],
        ]);
    }

    public function store(Request $request, string $table)
    {
        $config = $this->getConfig($table);
        $modelClass = $config['model'];
        $fillable = (new $modelClass)->getFillable();

        $fileColumns = $config['file_columns'] ?? [];
        if ($table === 'images' && in_array('fichier', $fileColumns) && !$request->hasFile('fichier')) {
            return back()->withErrors(['fichier' => 'Veuillez sélectionner une image à téléverser.'])->withInput();
        }

        $data = $request->only(array_intersect($fillable, $config['columns']));
        $data = $this->handleFileUploads($request, $data, $fileColumns);
        $data = $this->castData($modelClass, $data);

        if ($table === 'articles' && empty($data['slug']) && !empty($data['titre'])) {
            $data['slug'] = Str::slug($data['titre']);
        }

        $modelClass::create($data);

        return redirect()->route('admin.table.index', $table)
            ->with('success', 'Enregistrement créé.');
    }

    public function edit(string $table, int $id)
    {
        $config = $this->getConfig($table);
        $modelClass = $config['model'];
        $item = $modelClass::findOrFail($id);

        return view('admin.table-form', [
            'table' => $table,
            'label' => $config['label'],
            'item' => $item,
            'columns' => $config['columns'],
            'file_columns' => $config['file_columns'] ?? [],
            'edit' => true,
        ]);
    }

    public function update(Request $request, string $table, int $id)
    {
        $config = $this->getConfig($table);
        $modelClass = $config['model'];
        $item = $modelClass::findOrFail($id);
        $fillable = $item->getFillable();

        $data = $request->only(array_intersect($fillable, $config['columns']));
        $data = $this->handleFileUploads($request, $data, $config['file_columns'] ?? [], $item);
        $data = $this->castData($modelClass, $data);

        $item->update($data);

        return redirect()->route('admin.table.index', $table)
            ->with('success', 'Enregistrement mis à jour.');
    }

    public function destroy(string $table, int $id)
    {
        $config = $this->getConfig($table);
        $modelClass = $config['model'];
        $modelClass::findOrFail($id)->delete();

        return redirect()->route('admin.table.index', $table)
            ->with('success', 'Enregistrement supprimé.');
    }

    private function getConfig(string $table): array
    {
        $config = config("admin.tables.{$table}");
        if (! $config) {
            abort(404);
        }
        return $config;
    }

    private function handleFileUploads(Request $request, array $data, array $fileColumns, ?object $existingItem = null): array
    {
        foreach ($fileColumns as $col) {
            $croppedData = $request->input($col . '_cropped');
            if ($croppedData && str_starts_with($croppedData, 'data:image/')) {
                $data[$col] = $this->saveCroppedImage($croppedData, $col);
                continue;
            }

            if (!$request->hasFile($col)) {
                if ($existingItem && isset($existingItem->$col)) {
                    $data[$col] = $existingItem->$col;
                }
                continue;
            }
            $file = $request->file($col);
            if (!$file->isValid()) {
                continue;
            }
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . Str::random(6) . '.' . $extension;
            $file->move(public_path('images'), $filename);
            $data[$col] = $filename;
        }
        return $data;
    }

    private function saveCroppedImage(string $base64Data, string $key): string
    {
        $parts = explode(',', $base64Data, 2);
        $mime = str_replace(['data:', ';base64'], '', $parts[0]);
        $extension = match ($mime) {
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            default => 'jpg',
        };

        $filename = $key . '-' . now()->timestamp . '-' . Str::random(4) . '.' . $extension;
        file_put_contents(public_path('images/' . $filename), base64_decode($parts[1]));

        return $filename;
    }

    private function castData(string $modelClass, array $data): array
    {
        $model = new $modelClass;
        $casts = $model->getCasts();

        foreach ($data as $key => $value) {
            if ($value === null && !in_array($key, ['date_publication', 'contenu', 'image'])) {
                $data[$key] = '';
            }
            if (isset($casts[$key])) {
                if ($casts[$key] === 'boolean') {
                    $data[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                }
                if ($casts[$key] === 'date' || str_starts_with($casts[$key] ?? '', 'date')) {
                    $data[$key] = $value ?: null;
                }
            }
        }

        return $data;
    }
}
