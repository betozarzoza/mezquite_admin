<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movement;

class Houses extends Model
{
    use HasFactory;

    public function movements()
    {
        return $this->hasMany(Movement::class, 'addressat', 'id');
    }
}
