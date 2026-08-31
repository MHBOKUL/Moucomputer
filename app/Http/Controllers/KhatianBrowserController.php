<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Mouza;
use App\Models\Khatian;

class KhatianBrowserController extends Controller
{
    /**
     * Public Khatian Homepage
     */
    public function index()
    {
        $divisions = Division::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'khatians.index',
            compact('divisions')
        );
    }


    /**
     * Get districts under division.
     * AJAX → JSON
     */
    public function districts(Division $division)
    {
        abort_unless($division->status, 404);

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
     * Get upazilas under district.
     * AJAX → JSON
     */
    public function upazilas(District $district)
    {
        abort_unless($district->is_active, 404);

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
     * Get mouzas under upazila.
     * AJAX → JSON
     */
    public function mouzas(Upazila $upazila)
    {
        $mouzas = $upazila->mouzas()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'upazila_id',
                'name',
                'name_bn',
            ]);

        return response()->json($mouzas);
    }


    /**
     * Get khatians under mouza.
     * AJAX → JSON
     */
    public function khatians(Mouza $mouza)
    {
        abort_unless($mouza->is_active, 404);

        $khatians = $mouza->khatians()
            ->with('surveyType')
            ->where('is_active', true)
            ->latest()
            ->get();

        return response()->json($khatians);
    }


    /**
     * Show public Khatian details.
     */
    public function show(Khatian $khatian)
    {
        abort_unless($khatian->is_active, 404);

        $khatian->load([
            'mouza.upazila.district.division',
            'surveyType',
        ]);

        return view(
            'khatians.show',
            compact('khatian')
        );
    }
}