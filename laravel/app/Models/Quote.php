<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    /**
     * Get the associate that owns the quote.
     */
    public function associate()
    {
        return $this->belongsTo(User::class, 'associate_id');
    }
}
