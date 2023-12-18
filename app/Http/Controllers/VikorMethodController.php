<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\CriteriaModel;
use App\Models\AlternatifSkor;
use Illuminate\Http\Request;

class VikorMethodController extends Controller
{
    //
    public function index()
    {
        $alternatif = AlternatifModel::all();
        $criterion = CriteriaModel::all();
        $scores = AlternatifSkor::with(['alternatif', 'criteria'])->get();

        // get weight from criteria
        $weights =  $criterion->pluck('weight');
        $sumWeight = $weights->sum();
        // calculate weight / sum weight
        foreach ($weights as $key => $weight) {
            $weights[$key] = number_format($weight / $sumWeight, 3);
        }

        $f_plus = [];
        $f_min = [];

        // calculate f_plus max for each criteria value and f_min min for each criteria value
        foreach ($criterion as $c) {
            $criteriaId = $c->id;
            $f_plus[$criteriaId] = $scores->where('criteria_id', $criteriaId)->pluck('score')->max();
            $f_min[$criteriaId] = $scores->where('criteria_id', $criteriaId)->pluck('score')->min();
        }

        // normalize matrix
        $normalizedMatrix = [];

        foreach ($scores as $sc) {
            $criteriaId = $sc->criteria_id;
            $alternatifId = $sc->alternatif_id;
            $score = $sc->score;

            if (!isset($normalizedMatrix[$alternatifId])) {
                $normalizedMatrix[$alternatifId] = [];
            }

            $normalizedMatrix[$alternatifId][$criteriaId] = number_format(($f_plus[$criteriaId] - $score) / ($f_plus[$criteriaId] - $f_min[$criteriaId]), 3);
        }

        // dd($normalizedMatrix);


        // calculate Weighted Matrix
        $weightedMatrix = [];

        foreach ($normalizedMatrix as $alternatifId => $criteriaValue) {
            foreach ($criteriaValue as $criteriaId => $normalizedValue) {
                if (!isset($weightedMatrix[$alternatifId])) {
                    $weightedMatrix[$alternatifId] = [];
                }

                $weightedMatrix[$alternatifId][$criteriaId] = number_format($weights[$criteriaId - 1] * $normalizedValue, 3);
            }
        }

        // calculate utility measure (S and R)
        foreach ($weightedMatrix as $alternatifId => $criteriaValue) {
            $s[$alternatifId] = 0;
            $r[$alternatifId] = 0;
            foreach ($criteriaValue as $criteriaId => $weightedValue) {
                $s[$alternatifId] += number_format($weightedValue, 3);
                $r[$alternatifId] = number_format(max($r[$alternatifId], $weightedValue),3);
            }
        }

        // calculate vikor index (Q)
        $s_min = min($s);
        $s_max = max($s);
        $r_min = min($r);
        $r_max = max($r);
        $v = 0.5;

        foreach ($s as $alternatifId => $s_value) {
            $r_value = $r[$alternatifId];
            $q[$alternatifId] = number_format(($v * (($s_value - $s_min) / ($s_max - $s_min))) + ((1 - $v) * (($r_value - $r_min) / ($r_max - $r_min))),3);
        }

        // merge q value and alternatif
        $result = array_combine($alternatif->pluck('name')->toArray(), $q);

        // sort result by q value from lowest to highest
        asort($result);
        arsort($result);

        // return view
        return view('calculate.index', compact(
            'alternatif',
            'criterion',
            'scores',
            'weights',
            'normalizedMatrix',
            'weightedMatrix',
            's_min',
            's_max',
            'r_min',
            'r_max',
            'v',
            'q',
            'result'
        ));
    }
}
