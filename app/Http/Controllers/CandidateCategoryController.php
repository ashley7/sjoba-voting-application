<?php

namespace App\Http\Controllers;

use App\CandidateCategory;
use Illuminate\Http\Request;

class CandidateCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = CandidateCategory::paginate(50);

        $data = [

            'title' => "List of positions",

            'positions' => $positions

        ];

        return view("candidate.category_list")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(\Auth::user()->user_type != "admin") return redirect()->route("candidate_category.index");

        $data = [

            'title' => "Create a position",        

        ];

        return view("candidate.category")->with($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [

            'name' => 'required|unique:candidate_categories',

        ];

        $this->validate($request,$rules);

        $saveCandidateCategory = new CandidateCategory();

        $saveCandidateCategory->name = $request->name;

        $saveCandidateCategory->save();

        return redirect()->route('candidate_category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CandidateCategory  $candidateCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CandidateCategory $candidateCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CandidateCategory  $candidateCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($candidateCategory)
    {

        $readCandidateCategory = CandidateCategory::find($candidateCategory);

        $data = [

            'title' => "Edit position",

            'readCandidateCategory' => $readCandidateCategory

        ];

        return view("candidate.edit_category")->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CandidateCategory  $candidateCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $candidateCategory)
    {
        $saveCandidateCategory = CandidateCategory::find($candidateCategory);

        $saveCandidateCategory->name = $request->name;

        $saveCandidateCategory->save();

        return redirect()->route('candidate_category.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CandidateCategory  $candidateCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($candidateCategory)
    {
        try {
            CandidateCategory::destroy($candidateCategory);
        } catch (\Exception $e) {}

        return back();
    }
}
