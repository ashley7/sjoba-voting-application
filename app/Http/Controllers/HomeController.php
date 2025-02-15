<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CandidateCategory;
use App\Candidate;
use App\VoteProcess;
use App\Vote;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

        if(Auth::user()->user_type != "admin") return redirect()->route("bullot_paper");

        $readCandidateCategory = CandidateCategory::get();

        $data = [

            'title' => env("APP_NAME")." ".date("Y")." RESULTS",    

            'readCandidateCategories' => $readCandidateCategory,        

        ];

        return view('home')->with($data);
    }

    public function bullotPaper()
    {

        $readCandidateCategory = CandidateCategory::get();

        $voteTime = VoteProcess::voteTime();

        

        if(!VoteProcess::votingTime()) return view('not_yet_time')->with(['title'=>'Not yet voting time','voteTime'=>$voteTime]);

        $data = [

            'readCandidateCategories' => $readCandidateCategory,

            'title' => "BALLOT PAPER",

            'voting_time' => $voteTime,

        ];

        return view("bullot_paper")->with($data);
         
    }

    public function vote(Request $request)
    {

        $vote_time = VoteProcess::voteTime();

        if(Carbon::parse($vote_time->end_time)->isPast())

         return "Vote cast failed, votting ended at ". Carbon::parse($vote_time->end_time)->format('Y-m-d h:i a');

        $readCandidate = Candidate::find($request->candidate_selected);

        $check = Vote::where('candidate_category_id',$readCandidate->candidate_category_id)->where('user_id',Auth::id())->get();

        $message = "Failed to make a vote";        

        if($check->count() == 0){

            $saveVote = new Vote();

            $message = "Vote for ".$readCandidate->candidateCategory->name. " custed successfuly";

        }elseif($check->count() == 1){

            $saveVote = $check->last();

            $message = "Vote for ".$readCandidate->candidateCategory->name. " updated successfuly";

        }        

        $saveVote->user_id = Auth::id();

        $saveVote->candidate_category_id = $readCandidate->candidate_category_id;

        $saveVote->candidate_id = $readCandidate->id;

        $saveVote->save();

        return $message;
         
    }

    public function thoseThatVoted()
    {

        $check = Vote::select('user_id')->get();

        $users = [];

        foreach ($check as $key => $value) {

            $users[] = $value->user_id;

        }

        $usersThatVoted = array_unique($users);

        $voters = User::whereIn('id',$usersThatVoted)->paginate(100);     

        $data = [

            'title' => "List of voters that voted",

             'voters' => $voters

        ];

        return view("voter.list")->with($data);
         
    }
}
