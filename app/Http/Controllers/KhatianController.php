<?php

namespace App\Http\Controllers;

use App\Models\Khatian;
use Illuminate\View\View;

class KhatianController extends Controller
{
    /**
     * Display the specified active khatian.
     */
    public function show(Khatian $khatian): View
    {
        $khatian->load([
            'mouza.upazila.district.division',
            'surveyType',
        ]);

        abort_unless($khatian->is_active, 404);

        return view('khatians.show', compact('khatian'));
    }
}