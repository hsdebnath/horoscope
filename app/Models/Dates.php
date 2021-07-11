<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dates extends Model
{
    use HasFactory;

    /**
     * Get the Scores for the date.
     */
    public function Scores()
    {
        return $this->hasMany(Scores::class);
    }

}
