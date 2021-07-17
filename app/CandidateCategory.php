<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateCategory extends Model
{
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
