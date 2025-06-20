<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function scopeSeason($query,$year)
    {
        return $query->whereYear('date', '=', $year);
    }
}
