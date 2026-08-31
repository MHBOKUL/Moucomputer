<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Khatian;
use App\Models\Mouza;
use App\Models\SurveyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KhatianController extends Controller
{
    /**
     * Display a listing of khatians.
     */
    public function index()
    {
        $khatians = Khatian::with([
            'mouza.upazila.district.division',
            'surveyType',
        ])
            ->latest()
            ->paginate(15);

        return view('admin.khatians.index', compact('khatians'));
    }


    /**
     * Show the form for creating a new khatian.
     */
    public function create()
    {
        $mouzas = Mouza::with([
            'upazila.district.division',
        ])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $surveyTypes = SurveyType::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.khatians.create', compact(
            'mouzas',
            'surveyTypes'
        ));
    }


    /**
     * Store a newly created khatian.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mouza_id' => [
                'required',
                'exists:mouzas,id',
            ],

            'survey_type_id' => [
                'required',
                'exists:survey_types,id',
            ],

            'khatian_number' => [
                'required',
                'string',
                'max:255',
            ],

            'owner_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'pdf' => [
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
        | Upload PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('pdf')) {
            $validated['pdf_path'] = $request
                ->file('pdf')
                ->store('khatians', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Active Status
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | Remove Uploaded File Field
        |--------------------------------------------------------------------------
        */

        unset($validated['pdf']);


        /*
        |--------------------------------------------------------------------------
        | Create Khatian
        |--------------------------------------------------------------------------
        */

        Khatian::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.khatians.index')
            ->with('success', 'Khatian created successfully.');
    }


    /**
     * Display the specified khatian.
     */
    public function show(Khatian $khatian)
    {
        $khatian->load([
            'mouza.upazila.district.division',
            'surveyType',
        ]);

        return view('admin.khatians.show', compact('khatian'));
    }


    /**
     * Show the form for editing the specified khatian.
     */
    public function edit(Khatian $khatian)
    {
        $mouzas = Mouza::with([
            'upazila.district.division',
        ])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $surveyTypes = SurveyType::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.khatians.edit', compact(
            'khatian',
            'mouzas',
            'surveyTypes'
        ));
    }


    /**
     * Update the specified khatian.
     */
    public function update(Request $request, Khatian $khatian)
    {
        $validated = $request->validate([
            'mouza_id' => [
                'required',
                'exists:mouzas,id',
            ],

            'survey_type_id' => [
                'required',
                'exists:survey_types,id',
            ],

            'khatian_number' => [
                'required',
                'string',
                'max:255',
            ],

            'owner_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'pdf' => [
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
        | Replace Existing PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('pdf')) {

            // Delete old PDF
            if ($khatian->pdf_path) {
                Storage::disk('public')->delete(
                    $khatian->pdf_path
                );
            }

            // Store new PDF
            $validated['pdf_path'] = $request
                ->file('pdf')
                ->store('khatians', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Active Status
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | Remove Uploaded File Field
        |--------------------------------------------------------------------------
        */

        unset($validated['pdf']);


        /*
        |--------------------------------------------------------------------------
        | Update Khatian
        |--------------------------------------------------------------------------
        */

        $khatian->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.khatians.index')
            ->with('success', 'Khatian updated successfully.');
    }


    /**
     * Remove the specified khatian.
     */
    public function destroy(Khatian $khatian)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete PDF From Storage
        |--------------------------------------------------------------------------
        */

        if ($khatian->pdf_path) {
            Storage::disk('public')->delete(
                $khatian->pdf_path
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Khatian Record
        |--------------------------------------------------------------------------
        */

        $khatian->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.khatians.index')
            ->with('success', 'Khatian deleted successfully.');
    }
}