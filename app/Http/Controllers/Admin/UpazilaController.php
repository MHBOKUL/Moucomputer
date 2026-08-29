<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function index()
    {
        $upazilas = Upazila::with('district.division')
            ->latest()
            ->get();

        return view('admin.upazilas.index', compact('upazilas'));
    }

    public function create()
    {
        $districts = District::where('is_active', true)
            ->with('division')
            ->orderBy('name')
            ->get();

        return view('admin.upazilas.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'district_id' => ['required', 'exists:districts,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_bn' => ['nullable', 'string', 'max:255'],
        ]);

        Upazila::create($validated);

        return redirect()
            ->route('admin.upazilas.index')
            ->with('success', 'Upazila added successfully.');
    }

    public function show(Upazila $upazila)
    {
        $upazila->load('district.division');

        return view('admin.upazilas.show', compact('upazila'));
    }

    public function edit(Upazila $upazila)
    {
        $districts = District::where('is_active', true)
            ->with('division')
            ->orderBy('name')
            ->get();

        return view('admin.upazilas.edit', compact(
            'upazila',
            'districts'
        ));
    }

    public function update(Request $request, Upazila $upazila)
    {
        $validated = $request->validate([
            'district_id' => ['required', 'exists:districts,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_bn' => ['nullable', 'string', 'max:255'],
        ]);

        $upazila->update($validated);

        return redirect()
            ->route('admin.upazilas.index')
            ->with('success', 'Upazila updated successfully.');
    }

    public function destroy(Upazila $upazila)
    {
        $upazila->delete();

        return redirect()
            ->route('admin.upazilas.index')
            ->with('success', 'Upazila deleted successfully.');
    }
}