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
     * Display all active divisions.
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
     * Get active districts of a division.
     */
    public function districts(Division $division): JsonResponse
    {
        $districts = District::query()
            ->where('division_id', $division->id)
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
     * Get upazilas of a district.
     *
     * NOTE:
     * The upazilas table currently does not contain
     * an is_active column.
     */
    public function upazilas(District $district): JsonResponse
    {
        $upazilas = Upazila::query()
            ->where('district_id', $district->id)
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
     * Get active mouzas of an upazila.
     */
    public function mouzas(Upazila $upazila): JsonResponse
    {
        $mouzas = Mouza::query()
            ->where('upazila_id', $upazila->id)
            ->where('is_active', true)
            ->with('surveyType')
            ->orderBy('name')
            ->get([
                'id',
                'upazila_id',
                'survey_type_id',
                'name',
                'name_bn',
                'jl_number',
            ]);

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
     * Get active maps of a mouza.
     */
    public function maps(Mouza $mouza): JsonResponse
    {
        $maps = Map::query()
            ->where('mouza_id', $mouza->id)
            ->where('is_active', true)
            ->with([
                'mouza',
                'mouza.surveyType',
            ])
            ->latest()
            ->get();

        return response()->json(
            $maps->map(function ($map) {
                return [
                    'id' => $map->id,
                    'title' => $map->title,
                    'price' => $map->price,

                    'mouza' => $map->mouza?->name,

                    'jl_number' => $map->mouza?->jl_number,

                    'survey_type' =>
                        $map->mouza?->surveyType?->name,

                    'view_url' =>
                        route('maps.show', $map),

                    'order_url' =>
                        route('orders.create', $map),
                ];
            })
        );
    }
}