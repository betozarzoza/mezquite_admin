<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Houses;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Movement extends Model
{
    use HasFactory;


    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function house()
    {
        return $this->belongsTo(Houses::class, 'addressat');
    }
}
