<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternatifModel;
use App\Models\CriteriaModel;
use App\Models\AlternatifSkor;

class DecisionMatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatif = AlternatifModel::all();
        $criterion = CriteriaModel::all();
        $scores = AlternatifSkor::with(['alternatif', 'criteria'])->get();
        return view('decisionmatrix.index', compact('alternatif', 'criterion', 'scores'));
    }

}
