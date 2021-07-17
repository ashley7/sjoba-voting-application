<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VoteProcess extends Model
{

    public static function votingTime()
    {

        $readVoteProcess = VoteProcess::get();

        $vote_time = now();

        if($readVoteProcess->count() == 1) {

            $readVoteProcess = $readVoteProcess->last();

            return Carbon::parse($readVoteProcess->starting_time)->diffForHumans();;

        }else{

            return now()->diffForHumans();

        }          
         
    }
}
