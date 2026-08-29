<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of districts.
     */
    public function index()
    {
        $districts = District::with('division')
            ->latest()
            ->get();

        return view('admin.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new district.
     */
    public function create()
    {
        $divisions = Division::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.districts.create', compact('divisions'));
    }

    /**
     * Store a newly created district.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => ['required', 'exists:divisions,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_bn' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        District::create($validated);

        return redirect()
            ->route('admin.districts.index')
            ->with('success', 'District added successfully.');
    }

    /**
     * Display the specified district.
     */
    public function show(District $district)
    {
        $district->load('division');

        return view('admin.districts.show', compact('district'));
    }

    /**
     * Show the form for editing the specified district.
     */
    public function edit(District $district)
    {
        $divisions = Division::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.districts.edit', compact(
            'district',
            'divisions'
        ));
    }

    /**
     * Update the specified district.
     */
    public function update(Request $request, District $district)
    {
        $validated = $request->validate([
            'division_id' => ['required', 'exists:divisions,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_bn' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $district->update($validated);

        return redirect()
            ->route('admin.districts.index')
            ->with('success', 'District updated successfully.');
    }

    /**
     * Remove the specified district.
     */
    public function destroy(District $district)
    {
        $district->delete();

        return redirect()
            ->route('admin.districts.index')
            ->with('success', 'District deleted successfully.');
    }
}