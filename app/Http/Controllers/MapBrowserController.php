<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Mouza;
use App\Models\Map;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MapBrowserController extends Controller
{
    /**
     * Display the Mouza Map Browser.
     */
    public function index(): View
    {
        $divisions = Division::query()
            ->where('status', true)
            ->withCount([
                'districts' => function ($query) {
                    $query->where('is_active', true);
                }
            ])
            ->orderBy('name')
            ->get();

        return view('maps.browse', compact('divisions'));
    }


    /**
     * Get districts by division.
     */
    public function districts(Division $division): JsonResponse
    {
        $districts = $division->districts()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'division_id',
                'name',
                'name_bn',
            ]);

        return response()->json($districts);
    }


    /**
     * Get upazilas by district.
     */
    public function upazilas(District $district): JsonResponse
    {
        $upazilas = $district->upazilas()
            ->orderBy('name')
            ->get([
                'id',
                'district_id',
                'name',
                'name_bn',
            ]);

        return response()->json($upazilas);
    }


    /**
     * Get mouzas by upazila.
     */
    public function mouzas(Upazila $upazila): JsonResponse
    {
        $mouzas = $upazila->mouzas()
            ->where('is_active', true)
            ->with('surveyType')
            ->orderBy('name')
            ->get();

        return response()->json(
            $mouzas->map(function ($mouza) {
                return [
                    'id' => $mouza->id,
                    'name' => $mouza->name,
                    'name_bn' => $mouza->name_bn,
                    'jl_number' => $mouza->jl_number,
                    'survey_type_id' => $mouza->survey_type_id,
                    'survey_type' => $mouza->surveyType?->name,
                ];
            })
        );
    }


    /**
     * Get available maps.
     */
    public function maps(Mouza $mouza): JsonResponse
    {
        $maps = $mouza->maps()
            ->where('is_active', true)
            ->with('mouza.surveyType')
            ->latest()
            ->get();

        return response()->json(
            $maps->map(function ($map) {
                return [
                    'id' => $map->id,
                    'title' => $map->title,
                    'price' => $map->price,
                    'file_name' => $map->file_name,
                    'mouza' => $map->mouza?->name,
                    'mouza_bn' => $map->mouza?->name_bn,
                    'jl_number' => $map->mouza?->jl_number,
                    'survey_type' => $map->mouza?->surveyType?->name,
                    'view_url' => route('maps.show', $map),
                    'order_url' => route('orders.create', $map),
                ];
            })
        );
    }
}