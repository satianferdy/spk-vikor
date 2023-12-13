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
        return view('criteria.index', compact('criterion'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'name' => 'required|unique:criteria_models',
                'type' => 'required',
                'weight' => 'required',
                'description' => 'required',
            ]);

            CriteriaModel::create($request->all());

            return redirect()->route('criteria.index')
                            ->with('success', 'Criteria created succesfully');

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Error code 1062 is for duplicate entry
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['name' => 'Nama kriteria sudah ada.']);
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
        //
        return view('criteria.edit', compact('criterion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CriteriaModel $criterion)
    {
        //
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'description' => 'required',
        ]);

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
