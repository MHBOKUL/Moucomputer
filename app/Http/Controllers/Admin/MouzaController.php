<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mouza;
use App\Models\Upazila;
use App\Models\SurveyType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MouzaController extends Controller
{
    /**
     * Display a listing of mouzas.
     */
    public function index()
    {
        $mouzas = Mouza::with([
            'upazila.district.division',
            'surveyType'
        ])
        ->latest()
        ->get();

        return view('admin.mouzas.index', compact('mouzas'));
    }

    /**
     * Show the form for creating a new mouza.
     */
    public function create()
    {
        $upazilas = Upazila::with('district.division')
            ->orderBy('name')
            ->get();

        $surveyTypes = SurveyType::orderBy('name')
            ->get();

        return view('admin.mouzas.create', compact(
            'upazilas',
            'surveyTypes'
        ));
    }

    /**
     * Store a newly created mouza.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'upazila_id' => [
                'required',
                'exists:upazilas,id',
            ],

            'survey_type_id' => [
                'required',
                'exists:survey_types,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'name_bn' => [
                'nullable',
                'string',
                'max:255',
            ],

            'jl_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Mouza::create($validated);

        return redirect()
            ->route('admin.mouzas.index')
            ->with('success', 'Mouza added successfully.');
    }

    /**
     * Display the specified mouza.
     */
    public function show(Mouza $mouza)
    {
        $mouza->load([
            'upazila.district.division',
            'surveyType'
        ]);

        return view('admin.mouzas.show', compact('mouza'));
    }

    /**
     * Show the form for editing the specified mouza.
     */
    public function edit(Mouza $mouza)
    {
        $upazilas = Upazila::with('district.division')
            ->orderBy('name')
            ->get();

        $surveyTypes = SurveyType::orderBy('name')
            ->get();

        return view('admin.mouzas.edit', compact(
            'mouza',
            'upazilas',
            'surveyTypes'
        ));
    }

    /**
     * Update the specified mouza.
     */
    public function update(Request $request, Mouza $mouza)
    {
        $validated = $request->validate([
            'upazila_id' => [
                'required',
                'exists:upazilas,id',
            ],

            'survey_type_id' => [
                'required',
                'exists:survey_types,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'name_bn' => [
                'nullable',
                'string',
                'max:255',
            ],

            'jl_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $mouza->update($validated);

        return redirect()
            ->route('admin.mouzas.index')
            ->with('success', 'Mouza updated successfully.');
    }

    /**
     * Remove the specified mouza.
     */
    public function destroy(Mouza $mouza)
    {
        $mouza->delete();

        return redirect()
            ->route('admin.mouzas.index')
            ->with('success', 'Mouza deleted successfully.');
    }
}