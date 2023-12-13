<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Http\Requests\UpdateAlternatifModelRequest;
use App\Models\AlternatifSkor;
use App\Models\CriteriaModel;
use Illuminate\Http\Request;

class AlternatifModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scores = AlternatifSkor::select(
            'alternatif_skors.id as id',
            'alternatif_models.id as ida',
            'alternatif_skors.score as score',
            'criteria_models.id as idc',
            'criteria_models.code as name',
            'criteria_models.type as type',
            'criteria_models.weight as weight',
            'criteria_models.description as description',
        )

            ->leftJoin('alternatif_models', 'alternatif_models.id', '=', 'alternatif_skors.alternatif_id')
            ->leftJoin('criteria_models', 'criteria_models.id', '=', 'alternatif_skors.criteria_id')
            ->get();

        $alternatif = AlternatifModel::get();

        $criterion = CriteriaModel::get();
        return view('alternatif.index', compact('scores', 'alternatif', 'criterion'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $criterion = CriteriaModel::get();
        return view('alternatif.create', compact('criterion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'score' => 'required|array',
            'score.*' => 'required|numeric',
        ]);

        //save alternatif
        $alt = new AlternatifModel;
        $alt->name = $request->name;
        $alt->save();

        //save skor
        $criterion = CriteriaModel::get();
        foreach ($criterion as $c) {
            $score = new AlternatifSkor();
            $score->alternatif_id = $alt->id;
            $score->criteria_id = $c->id;
            $score->score = $request->score[$c->id] ?? 0;
            $score->save();
        }

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AlternatifModel $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlternatifModel $alternatif)
    {
        //
        $criterion = CriteriaModel::get();
        $alternatifskor = AlternatifSkor::where('alternatif_id', $alternatif->id)->get();
        return view('alternatif.edit', compact('alternatif', 'alternatifskor', 'criterion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlternatifModel $alternatif)
    {
        //
        $request->validate([
            'name' => 'required',
            'score' => 'required|array',
            'score.*' => 'required|numeric',
        ]);

        //save skor
        $criterion = CriteriaModel::get();

        foreach ($criterion as $c) {
            $score = AlternatifSkor::updateOrCreate(
                [
                    'alternatif_id' => $alternatif->id,
                    'criteria_id' => $c->id,
                ],
                [
                    'score' => $request->score[$c->id] ?? 0,
                ]
            );
        }

        //save alternatif
        $alternatif->update([
            'name' => $request->name,
        ]);

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif updated succesfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlternatifModel $alternatif)
    {
        $score = AlternatifSkor::where('alternatif_id', $alternatif->id)->delete();
        $alternatif->delete();

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif deleted succesfully');
    }
}
