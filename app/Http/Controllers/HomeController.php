<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CandidateCategory;
use App\Candidate;
use App\Vote;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $readCandidateCategory = CandidateCategory::get();

        $data = [

            'title' => "2021 ELECTION RESULTS",    

            'readCandidateCategories' => $readCandidateCategory,        

        ];

        return view('home')->with($data);
    }

    public function bullotPaper()
    {

        $readCandidateCategory = CandidateCategory::get();

        $data = [

            'readCandidateCategories' => $readCandidateCategory,

            'title' => "BULLOT PAPER",

        ];

        return view("bullot_paper")->with($data);
         
    }

    public function vote(Request $request)
    {

        $readCandidate = Candidate::find($request->candidate_selected);

        $check = Vote::where('candidate_category_id',$readCandidate->candidate_category_id)->where('user_id',\Auth::id())->get();

        $message = "Failed to make a vote";        

        if($check->count() == 0){

            $saveVote = new Vote();

            $message = "Vote for ".$readCandidate->candidateCategory->name. " custed successfuly";

        }elseif($check->count() == 1){

            $saveVote = $check->last();

            $message = "Vote for ".$readCandidate->candidateCategory->name. " updated successfuly";

        }        

        $saveVote->user_id = \Auth::id();

        $saveVote->candidate_category_id = $readCandidate->candidate_category_id;

        $saveVote->candidate_id = $readCandidate->id;

        $saveVote->save();

        return $message;
         
    }
}
