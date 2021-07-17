<?php

namespace App\Http\Controllers;

use App\Vote;
use App\User;
use Illuminate\Http\Request;
use App\AfricasTalkingGateway;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $voters = User::paginate(50);

        $data = [

            'title' => "List of voters",

            'voters' => $voters

        ];

        return view("voter.list")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(\Auth::user()->user_type != "admin") return redirect()->route("voters.index");

        $data = [

            'title' => "Create a voter",

        ];

        return view("voter.create")->with($data);
        
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

            'phone_number' => 'required|unique:users',

        ];

        $this->validate($request,$rules);

        $pin = rand(1000,9000);

        $save_user = User::saveUser($request->name,$request->phone_number,$pin,"voter");

        if(!empty($save_user)){    

            $message = "Hello ".$save_user->name.", Your SJOBA Voter's account has been created, On the voting day you will use Phone Number: ".$save_user->phone_number." and Pin: ".$save_user->pin." to vote. Do not share your pin. Thank you";

 
            $reciever = User::validatePhoneNumber($save_user->phone_number);   

            try {

                $gateway    = new AfricasTalkingGateway(env("SMSUSERNAME"), env("SMSAPIKEY"));

                $gateway->sendMessage($reciever, $message);
                         
            } catch (\Exception $e) {}  

        }     

        return redirect()->route('voters.index')->with(['status'=>'Voter created successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit($vote)
    {
        $readVote = User::find($vote);

        $data = [

            'readVote' => $readVote,

            'title' => 'Edit voter information'


        ];

        return view("voter.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vote)
    {
        
        $saveUser = User::find($vote);        

        $saveUser->name = $request->name;        

        $saveUser->phone_number = $request->phone_number;

        $saveUser->save();

        return redirect()->route("voters.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy($vote)
    {

    }
}
