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
        $criteriaModel = CriteriaModel::get();
        return view('criteria.index', compact('criteriaModel'))->with('i', 0);
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
                'name' => 'required|unique:criteriaModel',
                'type' => 'required',
                'weight' => 'required',
                'description' => 'required',
            ]);

            CriteriaModel::create($request->all());

            return redirect()->route('criteria.index')
                            ->with('succes', 'Criteria created succesfully');
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
    public function edit(CriteriaModel $criteriaModel)
    {
        //
        return view('criteria.edit', compact('criteriaModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CriteriaModel $criteriaModel)
    {
        //
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'description' => 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $criteriaModel = CriteriaModel::find($id)->delete();

        return redirect()->route('criteria.index')
                        ->with('succes', 'Criteria deleted succesfully');
    }
}
