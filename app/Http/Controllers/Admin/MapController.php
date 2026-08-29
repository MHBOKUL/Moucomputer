<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Map;
use App\Models\Mouza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    public function index()
    {
        $maps = Map::with([
            'mouza.upazila.district.division',
            'mouza.surveyType'
        ])
        ->latest()
        ->get();

        return view('admin.maps.index', compact('maps'));
    }

    public function create()
    {
        $mouzas = Mouza::with([
            'upazila.district.division',
            'surveyType'
        ])
        ->where('is_active', true)
        ->orderBy('name')
        ->get();

        return view('admin.maps.create', compact('mouzas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mouza_id' => ['required', 'exists:mouzas,id'],
            'title' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:20480'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $file = $request->file('file');

        $path = $file->store('maps', 'public');

        Map::create([
            'mouza_id' => $validated['mouza_id'],
            'title' => $validated['title'],
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'price' => $validated['price'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.maps.index')
            ->with('success', 'Map added successfully.');
    }

    public function show(Map $map)
    {
        $map->load([
            'mouza.upazila.district.division',
            'mouza.surveyType'
        ]);

        return view('admin.maps.show', compact('map'));
    }

    public function edit(Map $map)
    {
        $mouzas = Mouza::with([
            'upazila.district.division',
            'surveyType'
        ])
        ->where('is_active', true)
        ->orderBy('name')
        ->get();

        return view('admin.maps.edit', compact(
            'map',
            'mouzas'
        ));
    }

    public function update(Request $request, Map $map)
    {
        $validated = $request->validate([
            'mouza_id' => ['required', 'exists:mouzas,id'],
            'title' => ['required', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data = [
            'mouza_id' => $validated['mouza_id'],
            'title' => $validated['title'],
            'price' => $validated['price'],
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('file')) {

            if ($map->file_path && Storage::disk('public')->exists($map->file_path)) {
                Storage::disk('public')->delete($map->file_path);
            }

            $file = $request->file('file');

            $data['file_path'] = $file->store('maps', 'public');
            $data['file_name'] = $file->getClientOriginalName();
        }

        $map->update($data);

        return redirect()
            ->route('admin.maps.index')
            ->with('success', 'Map updated successfully.');
    }

    public function destroy(Map $map)
    {
        if ($map->file_path && Storage::disk('public')->exists($map->file_path)) {
            Storage::disk('public')->delete($map->file_path);
        }

        $map->delete();

        return redirect()
            ->route('admin.maps.index')
            ->with('success', 'Map deleted successfully.');
    }

    /**
     * Download PDF
     */
    public function download(Map $map)
    {
        if (
            !$map->file_path ||
            !Storage::disk('public')->exists($map->file_path)
        ) {
            abort(404, 'Map file not found.');
        }

        return Storage::disk('public')->download(
            $map->file_path,
            $map->file_name ?? basename($map->file_path)
        );
    }
}