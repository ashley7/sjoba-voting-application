<?php

namespace App\Http\Controllers;

use App\Vote;
use App\VoteProcess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->user_type != "admin") 
        
            return redirect()->route("bullot_paper");
       
        $voting_time = VoteProcess::voteTime();

        $data = [
        
            'title' => "Voting time",
            'voting_time'=>$voting_time,

        ];

        return view("voting_time")->with($data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $vote_time = VoteProcess::voteTime();

        if(empty($vote_time)) return "Vote time has not yet been established.";

        if(Carbon::parse($vote_time->end_time)->isPast()) 
        
            return "Voting ended ".Carbon::parse($vote_time->end_time)->format('Y-m-d h:i a');

        if(!VoteProcess::votingTime()) 

            return empty($vote_time) ? "Voting time is not set":"Voting will start at ". Carbon::parse($vote_time->starting_time)->format('Y-m-d h:i a')." and end ". Carbon::parse($vote_time->end_time)->format('Y-m-d h:i a');

        else

            return "Voting started ". Carbon::parse($vote_time->starting_time)->diffForHumans()." and will end at ".Carbon::parse($vote_time->end_time)->format('Y-m-d h:i a');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,['starting_time'=>'required']);

        $voting_times = VoteProcess::get();

        if($voting_times->count() == 0)

            $saveVoteProcess = new VoteProcess();

        else

            $saveVoteProcess = $voting_times->last();
        

        $saveVoteProcess->starting_time = $request->starting_time;

        $saveVoteProcess->end_time = $request->end_time;

        $saveVoteProcess->save();

        return view('not_yet_time')->with(['status'=>'Dates updated','title'=>'Votting time','voteTime'=>$saveVoteProcess]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VoteProcess  $voteProcess
     * @return \Illuminate\Http\Response
     */
    public function show(VoteProcess $voteProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VoteProcess  $voteProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(VoteProcess $voteProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VoteProcess  $voteProcess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoteProcess $voteProcess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VoteProcess  $voteProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy($voteProcess)
    {
         try {

            Vote::truncate();

         } catch (\Exception $e) {}

         return back();
    }
}
