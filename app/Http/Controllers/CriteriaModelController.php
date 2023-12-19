<?php

namespace App\Http\Controllers;

use App\Models\CriteriaModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CriteriaModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $criterion = CriteriaModel::get();

        // sum all weight
        $sumWeights = CriteriaModel::sum('weight');

        return view('criteria.index', compact('criterion'))->with('i', 0)->with('sumWeights', $sumWeights);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // sum all weight
        $sumWeights = CriteriaModel::sum('weight');
        return view('criteria.create')->with('sumWeights', $sumWeights);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'code' => 'required|unique:criteria_models',
                'type' => 'required',
                'weight' => 'required',
                'description' => 'required',
            ]);

            //make variable weight from request and sum all weight
            $weights = $request->weight;
            $weights = $weights + CriteriaModel::sum('weight');

            //check if sum of weight is more than 1
            if ($weights > 10.0) {
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['weight1' => 'Total weight cannot be more than 10.', 'weight2' => 'Please subtract weights from other criteria.']);
            }

            CriteriaModel::create($request->all());

            return redirect()->route('criteria.index')
                            ->with('success', 'Criteria created succesfully');

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Error code 1062 is for duplicate entry
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['name' => 'Criteria code already exists']);
            }
            // Handle other query exceptions if needed
            return redirect()->route('criteria.index')
                            ->with('error','Failed to create criteria.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CriteriaModel $criteriaModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CriteriaModel $criterion)
    {
        // sum all weight
        $sumWeights = CriteriaModel::sum('weight');
        return view('criteria.edit', compact('criterion'))->with('sumWeights', $sumWeights);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CriteriaModel $criterion)
    {
        //
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'description' => 'required',
        ]);

        //find weight from criterion
        $weightBefore = CriteriaModel::where('id', $criterion->id)->first()->weight;

        // make variable weight from request and sum all weight
        $weights = $request->weight;

        // subtract weight from criterion
        $weights -= $weightBefore;

        // sum all weight
        $weights = $weights + CriteriaModel::sum('weight');

        // check if sum of weight is more than 1
        if ($weights > 10.0) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['weight1' => 'Total weight cannot be more than 10.', 'weight2' => 'Please subtract weights from other criteria.']);
        }

        $criterion->update($request->all());

        return redirect()->route('criteria.index')
                        ->with('succes', 'Criteria updated succesfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        CriteriaModel::findorFail($id)->delete();

        return redirect()->route('criteria.index')
                        ->with('succes', 'Criteria deleted succesfully');
    }
}
