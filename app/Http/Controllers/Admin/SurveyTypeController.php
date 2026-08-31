<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyType;
use Illuminate\Http\Request;

class SurveyTypeController extends Controller
{
    public function index()
    {
        $surveyTypes = SurveyType::latest()->paginate(15);

        return view('admin.survey-types.index', compact('surveyTypes'));
    }

    public function create()
    {
        return view('admin.survey-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        SurveyType::create($validated);

        return redirect()
            ->route('admin.survey-types.index')
            ->with('success', 'Survey type created successfully.');
    }

    public function show(SurveyType $surveyType)
    {
        return view('admin.survey-types.show', compact('surveyType'));
    }

    public function edit(SurveyType $surveyType)
    {
        return view('admin.survey-types.edit', compact('surveyType'));
    }

    public function update(Request $request, SurveyType $surveyType)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $surveyType->update($validated);

        return redirect()
            ->route('admin.survey-types.index')
            ->with('success', 'Survey type updated successfully.');
    }

    public function destroy(SurveyType $surveyType)
    {
        $surveyType->delete();

        return redirect()
            ->route('admin.survey-types.index')
            ->with('success', 'Survey type deleted successfully.');
    }
}