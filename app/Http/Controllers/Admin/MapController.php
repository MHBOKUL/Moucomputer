<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Map;
use App\Models\Mouza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    /**
     * Display all maps.
     */
    public function index()
    {
        $maps = Map::with([
            'mouza.upazila.district.division',
            'mouza.surveyType',
        ])
            ->latest()
            ->get();

        return view('admin.maps.index', compact('maps'));
    }


    /**
     * Show the form for creating a new map.
     */
    public function create()
    {
        $mouzas = Mouza::with([
            'upazila.district.division',
            'surveyType',
        ])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.maps.create', compact('mouzas'));
    }


    /**
     * Store a newly created map.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mouza_id' => [
                'required',
                'exists:mouzas,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'file' => [
                'required',
                'file',
                'mimes:pdf',
                'max:20480',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload PDF
        |--------------------------------------------------------------------------
        */

        $file = $request->file('file');

        $filePath = $file->store('maps', 'public');


        /*
        |--------------------------------------------------------------------------
        | Create Map
        |--------------------------------------------------------------------------
        */

        Map::create([
            'mouza_id' => $validated['mouza_id'],
            'title' => $validated['title'],
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'price' => $validated['price'],
            'is_active' => $request->boolean('is_active'),
        ]);


        return redirect()
            ->route('admin.maps.index')
            ->with('success', 'Map added successfully.');
    }


    /**
     * Display the specified map in admin panel.
     */
    public function show(Map $map)
    {
        $map->load([
            'mouza.upazila.district.division',
            'mouza.surveyType',
        ]);

        return view('admin.maps.show', compact('map'));
    }


    /**
     * Display a public map details page.
     */
    public function publicShow(Map $map)
    {
        /*
        |--------------------------------------------------------------------------
        | Public Access
        |--------------------------------------------------------------------------
        |
        | Only active maps can be viewed by customers.
        |
        */

        if (!$map->is_active) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Map Relationships
        |--------------------------------------------------------------------------
        */

        $map->load([
            'mouza.upazila.district.division',
            'mouza.surveyType',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Public Map Details View
        |--------------------------------------------------------------------------
        */

        return view('maps.show', compact('map'));
    }


    /**
     * Show the form for editing the specified map.
     */
    public function edit(Map $map)
    {
        $mouzas = Mouza::with([
            'upazila.district.division',
            'surveyType',
        ])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.maps.edit', compact(
            'map',
            'mouzas'
        ));
    }


    /**
     * Update the specified map.
     */
    public function update(Request $request, Map $map)
    {
        $validated = $request->validate([
            'mouza_id' => [
                'required',
                'exists:mouzas,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:20480',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Basic Map Data
        |--------------------------------------------------------------------------
        */

        $data = [
            'mouza_id' => $validated['mouza_id'],
            'title' => $validated['title'],
            'price' => $validated['price'],
            'is_active' => $request->boolean('is_active'),
        ];


        /*
        |--------------------------------------------------------------------------
        | Replace PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('file')) {

            /*
            | Delete old PDF
            */

            if (
                !empty($map->file_path) &&
                Storage::disk('public')->exists($map->file_path)
            ) {
                Storage::disk('public')->delete($map->file_path);
            }


            /*
            | Upload new PDF
            */

            $file = $request->file('file');

            $newFilePath = $file->store('maps', 'public');


            /*
            | Save new file information
            */

            $data['file_path'] = $newFilePath;
            $data['file_name'] = $file->getClientOriginalName();
        }


        /*
        |--------------------------------------------------------------------------
        | Update Map
        |--------------------------------------------------------------------------
        */

        $map->update($data);


        return redirect()
            ->route('admin.maps.index')
            ->with('success', 'Map updated successfully.');
    }


    /**
     * Remove the specified map.
     */
    public function destroy(Map $map)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete PDF
        |--------------------------------------------------------------------------
        */

        if (
            !empty($map->file_path) &&
            Storage::disk('public')->exists($map->file_path)
        ) {
            Storage::disk('public')->delete($map->file_path);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */

        $map->delete();


        return redirect()
            ->route('admin.maps.index')
            ->with('success', 'Map deleted successfully.');
    }


    /**
     * Download map PDF from admin panel.
     */
    public function download(Map $map)
    {
        /*
        |--------------------------------------------------------------------------
        | Check File Path
        |--------------------------------------------------------------------------
        */

        if (empty($map->file_path)) {
            abort(404, 'Map file not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check PDF Exists
        |--------------------------------------------------------------------------
        */

        if (!Storage::disk('public')->exists($map->file_path)) {
            abort(404, 'Map PDF file does not exist.');
        }


        /*
        |--------------------------------------------------------------------------
        | Get Physical File Path
        |--------------------------------------------------------------------------
        */

        $filePath = Storage::disk('public')->path($map->file_path);


        /*
        |--------------------------------------------------------------------------
        | Original File Name
        |--------------------------------------------------------------------------
        */

        $downloadName = $map->file_name
            ?: basename($map->file_path);


        /*
        |--------------------------------------------------------------------------
        | Download PDF
        |--------------------------------------------------------------------------
        */

        return response()->download(
            $filePath,
            $downloadName,
            [
                'Content-Type' => 'application/pdf',
            ]
        );
    }
}