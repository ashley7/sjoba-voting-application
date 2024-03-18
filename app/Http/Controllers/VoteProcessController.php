<?php

namespace App\Http\Controllers;

use App\Vote;
use App\VoteProcess;
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

        if(Auth::user()->user_type != "admin") return redirect()->route("bullot_paper");
       
        $voting_time = VoteProcess::votingTime();

        $data = [
        
            'title' => "Voting time: ".$voting_time,

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

        $start_time = VoteProcess::votingTime();

        if(\Str::contains($start_time,"ago")) {

            return "The election started: ".$start_time;

        }else{

            return $start_time." to start the election";

        }

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

        VoteProcess::truncate();

        $saveVoteProcess = new VoteProcess();

        $saveVoteProcess->starting_time = $request->starting_time;

        $saveVoteProcess->save();

        return back();




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
