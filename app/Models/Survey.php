<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Survey extends Model
{
    use HasFactory;


    public function answers()
    {
        return $this->hasMany(Answer::class, 'survey_id', 'id');
    }
}
