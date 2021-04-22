<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'associate_id',
        'customer_id',
        'customer_name',
        'customer_email',
    ];

    /**
     * Get the associate that owns the quote.
     */
    public function associate()
    {
        return $this->belongsTo(User::class, 'associate_id');
    }

    /**
     * Get the associate that owns the quote.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the line items for the quote.
     */
    public function line_items()
    {
        return $this->hasMany(LineItem::class);
    }

    /**
     * Get the line items for the quote.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get the total amount for this quote.
     */
    public function getTotalAmountAttribute()
    {
        return $this->line_items->sum('subtotal');
    }
}
