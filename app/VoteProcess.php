<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VoteProcess extends Model
{

    public static function votingTime()
    {

        $readVoteProcess = VoteProcess::get();

        if($readVoteProcess->count() == 1) {

            $readVoteProcess = $readVoteProcess->last();

            if(Carbon::parse($readVoteProcess->starting_time)->isPast() && !Carbon::parse($readVoteProcess->end_time)->isPast())

              return TRUE;

        }

        return FALSE;          
         
    }


    public static function voteTime(){

        $readVoteProcess = VoteProcess::get();

        if($readVoteProcess->count() == 1) 

            return $readVoteProcess->last();        

        return NULL;

    }

}
