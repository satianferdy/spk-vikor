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

        // Normalisasi Vikor
        $minMax = [];
        $maxXi = [];
        $minXi = [];
        $rank = [];

        $desiredDecimalPlaces = 3; // Sesuaikan dengan kebutuhan

        foreach ($criterion as $c) {
            foreach ($scores as $s) {
                if ($s->criteria_id == $c->id) {
                    $minMax[$c->id][] = $s->score;
                }
            }

            // Check if there are values for the current $criteriaId
            if (!empty($minMax[$c->id])) {
                $values = $minMax[$c->id];
                $maxXi[$c->id] = max($minMax[$values]);
                $minXi[$c->id] = min($minMax[$values]);

                // Normalisasi and Weighting
                foreach ($values as $value) {
                    // Initialize $normalizedValue correctly using $value
                    $normalizedValue = 0;

                    if ($maxXi[$c->id] - $minXi[$c->id] != 0) {
                        if ($c->type == 'benefit') {
                            $normalizedValue = ($minXi[$c->id] - $value) / ($maxXi[$c->id] - $minXi[$c->id]);
                        } else {
                            $normalizedValue = ($value - $maxXi[$c->id]) / ($maxXi[$c->id] - $minXi[$c->id]);
                        }
                    }

                    // Round $normalizedValue to $desiredDecimalPlaces decimal places
                    $normalizedValue = round($normalizedValue, $desiredDecimalPlaces);

                    // Store $normalizedValue in the $tij
                    $tij[$c->id][] = $normalizedValue;

                }
            }
        }
    }
    // public function calculate(Request $request)
    // {
    //     // Mendapatkan data dari formulir
    //     $criteria = CriteriaModel::all();
    //     $alternatives = AlternatifModel::all();


    //     // Normalisasi data kriteria
    //     // TODO: Lakukan normalisasi data

    //     // Penentuan solusi ideal positif dan negatif
    //     // TODO: Tentukan solusi ideal positif (P) dan solusi ideal negatif (N)

    //     // Perhitungan jarak antara solusi ideal dan solusi negatif
    //     // TODO: Hitung jarak antara setiap alternatif dan solusi ideal (P dan N)

    //     // Peringkat alternatif
    //     // TODO: Lakukan peringkat alternatif berdasarkan jarak

    //     // Menampilkan hasil ke view
    //     return view('vkor.result', compact('ranking'));
    // }

}
