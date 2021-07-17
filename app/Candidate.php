<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function candidateCategory()
    {
        return $this->belongsTo(CandidateCategory::class);
    }
}
