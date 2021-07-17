<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

	public static function voted($candidate_category_id,$candidate_id)
	{
		$check = Vote::where('candidate_category_id',$candidate_category_id)->where('candidate_id',$candidate_id)->where('user_id',\Auth::id())->get();

		if($check->count() == 0)  

			return false ;

		if($check->count() == 1)  

			return true ;
	}

	public static function numberOfVotes($candidate_id)
	{

		return Vote::where('candidate_id',$candidate_id)->count();
		 
	}
    
}
