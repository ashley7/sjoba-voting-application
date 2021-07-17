<?php

namespace App\Http\Controllers;

use App\User;
use App\Candidate;
use App\CandidateCategory;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         
        
        $candidates = Candidate::get();

        $data = [

            'title' => "List of candidate",

            'candidates' => $candidates

        ];

        return view("candidate.list")->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(\Auth::user()->user_type != "admin") return redirect()->route("candidate.index");
        
        $positions = CandidateCategory::get();

        $data = [

            'title' => "Create a candidate",

            'positions' => $positions

        ];

        return view("candidate.create")->with($data);

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

            'name' => 'required',
            'position_id' => 'required',
            'picture' => 'required',         

        ];

        $this->validate($request,$rules);

        $saveCandidate = new Candidate();

        $saveCandidate->name = $request->name;

        $saveCandidate->candidate_category_id = $request->position_id;

        $saveCandidate->picture = User::uploadFile($request->file('picture'));

        $saveCandidate->save();

        return redirect()->route("candidate.index")->with(['status'=>'Candidate created successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit($candidate)
    {

        if(\Auth::user()->user_type != "admin") return redirect()->route("candidate.index");
        
        $positions = CandidateCategory::get();

        $readCandidate = Candidate::find($candidate);

        $data = [

            'readCandidate' => $readCandidate,

            'title' => "Edit candidate information",

            'positions' => $positions

        ];

        return view('candidate.edit_candidate')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $candidate)
    {

        $saveCandidate = Candidate::find($candidate);

        $saveCandidate->name = $request->name;

        $saveCandidate->candidate_category_id = $request->position_id;

        if (!empty($request->file('picture'))) {

            try {

                unlink(public_path('/files/'. $saveCandidate->picture));
                
            } catch (\Exception $e) {}

           $saveCandidate->picture = User::uploadFile($request->file('picture'));

        }        

        $saveCandidate->save();

        return redirect()->route("candidate.index")->with(['status'=>'Candidate updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy( $candidate)
    {

        if(\Auth::user()->user_type != "admin") return redirect()->route("candidate.index");
        try {
            Candidate::destroy($candidate);
        } catch (\Exception $e) {}

        return back();
    }
}
