<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quote;

class LineItem extends Model
{
    use HasFactory;

    /**
     * Get the quote that this line item is part of.
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * Get the total amount for this quote.
     */
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
