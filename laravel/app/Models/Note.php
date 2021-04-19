<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quote;

class Note extends Model
{
    use HasFactory;

    /**
     * Get the quote that this note is part of.
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
