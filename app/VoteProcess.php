<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VoteProcess extends Model
{

    // public static function votingTime()
    // {

    //     $readVoteProcess = VoteProcess::get();

    //     if($readVoteProcess->count() > 0) {

    //         $readVoteProcess = $readVoteProcess->last();

    //         if(Carbon::parse($readVoteProcess->starting_time)->isPast() && !Carbon::parse($readVoteProcess->end_time)->isPast())

    //           return TRUE;

    //     }

    //     return FALSE;          
         
    // }

    public static function votingTime()
    {
        $readVoteProcess = VoteProcess::orderBy('starting_time', 'desc')->first();

        if ($readVoteProcess) {
            $startTime = Carbon::parse($readVoteProcess->starting_time);
            $endTime = Carbon::parse($readVoteProcess->end_time);

            if ($startTime->isPast() && !$endTime->isPast()) {
                return true;
            }
        }

        return false;
    }



    public static function voteTime(){

        $readVoteProcess = VoteProcess::orderBy('starting_time', 'asc')->get();

        if($readVoteProcess->count() > 0) 

            return $readVoteProcess->last();        

        return NULL;

    }

}
