<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;

    /**
     * Get the dates that owns the score.
     */
    public function Dates()
    {
        return $this->belongsTo(Dates::class);
    }
}
