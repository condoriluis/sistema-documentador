<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DocumentController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'title' => 'required|array|min:1',
            'description' => 'required|array|min:1',
            'code' => 'required|array|min:1',
            'note' => 'nullable|array|min:1',
        ]);

        function limpiarTexto($texto)
        {

            $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
            $texto = preg_replace('/[^a-zA-Z0-9_]/', '_', $texto);
            return strtolower(preg_replace('/_{2,}/', '_', $texto));
        }

        $documents = [];
        foreach ($request->title as $index => $title) {
            $documents[] = [
                'name' => $request->name,
                'title' => $title,
                'description' => $request->description[$index],
                'code' => $request->code[$index],
                'note' => $request->note[$index] ?? null,
            ];
        }

        $json = json_encode($documents, JSON_PRETTY_PRINT);

        $cleanName = limpiarTexto($request->name);
        $fileName = 'documents/' . now()->format('YmdHis') . "_{$cleanName}.json";

        Storage::put($fileName, $json);

        return redirect()->route('documents.index')->with('success', 'Documento guardado correctamente.');
    }

    public function index(Request $request)
    {
        $files = Storage::files('documents');
        $documents = [];

        foreach ($files as $file) {
            $documents[] = [
                'filename' => basename($file),
                'data' => json_decode(Storage::get($file), true)
            ];
        }

        $documents = new Collection($documents);
        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $documents->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedDocuments = new LengthAwarePaginator(
            $currentItems,
            $documents->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return view('documents', compact('paginatedDocuments'));
    }

    public function show($filename)
    {
        $filePath = "documents/{$filename}";

        if (!Storage::exists($filePath)) {
            abort(404);
        }

        $document = json_decode(Storage::get($filePath), true);

        return view('show_documents', compact('document', 'filename'));
    }

    public function edit($filename)
    {
        $filePath = 'documents/' . $filename;

        if (!Storage::exists($filePath)) {
            return redirect()->route('documents.index')->with('error', 'El documento no existe.');
        }

        $jsonContent = Storage::get($filePath);
        $document = json_decode($jsonContent, true);

        return view('edit', ['document' => $document, 'filename' => $filename]);
    }

    public function update(Request $request, $filename)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'title' => 'required|array|min:1',
            'description' => 'required|array|min:1',
            'code' => 'required|array|min:1',
            'note' => 'nullable|array|min:1',
        ]);

        $documents = [];
        $titles = $request->title;
        $descriptions = $request->description;
        $codes = $request->code;
        $notes = $request->note;

        for ($i = 0; $i < count($titles); $i++) {
            $documents[] = [
                'name' => $request->name,
                'title' => $titles[$i],
                'description' => $descriptions[$i],
                'code' => $codes[$i],
                'note' => isset($notes[$i]) ? $notes[$i] : null,
            ];
        }

        $json = json_encode($documents, JSON_PRETTY_PRINT);

        $filePath = 'documents/' . $filename;

        Storage::put($filePath, $json);

        return redirect()->route('documents.index')->with('success', 'El documento ha sido actualizado correctamente.');
    }

    public function download($filename)
    {
        $filePath = "documents/{$filename}";

        if (!Storage::exists($filePath)) {
            return redirect()->route('documents.index')->with('error', 'El documento no existe.');
        }

        $document = json_decode(Storage::get($filePath), true);

        $htmlContent = view('show_documents', compact('document', 'filename'))->render();

        $cleanName = pathinfo($filename, PATHINFO_FILENAME);
        $htmlFileName = "{$cleanName}.html";

        return response($htmlContent)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename={$htmlFileName}");
    }

    public function destroy($filename)
    {
        $filePath = "documents/{$filename}";

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return redirect()->route('documents.index')->with('success', 'Documento eliminado correctamente.');
        }

        return redirect()->route('documents.index')->with('error', 'Documento no encontrado.');
    }
}
