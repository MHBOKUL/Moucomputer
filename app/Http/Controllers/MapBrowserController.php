<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Mouza;
use App\Models\Map;
use App\Models\Khatian;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MapBrowserController extends Controller
{
    /**
     * Display map browser page.
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
     * The upazilas table currently does not have
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
     *
     * This endpoint is called after the user selects a Mouza.
     */
    public function maps(Mouza $mouza): JsonResponse
    {
        $maps = Map::query()
            ->where('mouza_id', $mouza->id)
            ->where('is_active', true)
            ->with([
                'mouza.surveyType',
            ])
            ->latest()
            ->get();

        return response()->json(
            $maps->map(function ($map) {

                $surveyTypeName = $map->mouza?->surveyType?->name;

                /*
                 * Convert survey type name into
                 * frontend-friendly code.
                 */
                $surveyTypeCode = match (
                    strtolower(trim($surveyTypeName ?? ''))
                ) {
                    'revisional survey',
                    'rs' => 'RS',

                    'cadastral survey',
                    'cs' => 'CS',

                    default => null,
                };

                return [
                    /*
                     * Map information
                     */
                    'id' => $map->id,

                    'title' => $map->title,

                    'price' => $map->price,

                    'file_name' => $map->file_name,


                    /*
                     * Mouza information
                     */
                    'mouza' => $map->mouza?->name,

                    'jl_number' => $map->mouza?->jl_number,


                    /*
                     * Survey information
                     */
                    'survey_type_id' =>
                        $map->mouza?->survey_type_id,

                    'survey_type' =>
                        $surveyTypeCode,

                    'survey_type_name' =>
                        $surveyTypeName,


                    /*
                     * Public map details page
                     */
                    'view_url' =>
                        route('maps.show', ['map' => $map->id]),


                    /*
                     * Public order page
                     *
                     * IMPORTANT:
                     * Your actual route is:
                     *
                     * orders.map.create
                     *
                     * NOT:
                     *
                     * orders.create
                     */
                    'order_url' =>
                        route('orders.map.create', ['map' => $map->id]),
                ];
            })
        );
    }


    /**
     * Get active khatians of a mouza.
     */
    public function khatians(Mouza $mouza): JsonResponse
    {
        $khatians = Khatian::query()
            ->where('mouza_id', $mouza->id)
            ->where('is_active', true)
            ->with([
                'mouza',
                'mouza.surveyType',
                'surveyType',
            ])
            ->latest()
            ->get();

        return response()->json(
            $khatians->map(function ($khatian) {

                return [
                    'id' => $khatian->id,

                    'khatian_number' =>
                        $khatian->khatian_number,

                    'owner_name' =>
                        $khatian->owner_name,

                    'price' =>
                        $khatian->price,

                    'mouza' =>
                        $khatian->mouza?->name,

                    'jl_number' =>
                        $khatian->mouza?->jl_number,

                    'survey_type' =>
                        $khatian->surveyType?->name,

                    'view_url' =>
                        route('khatians.show', [
                            'khatian' => $khatian->id
                        ]),
                ];
            })
        );
    }
}
