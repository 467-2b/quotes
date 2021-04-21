<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quote_id',
        'purchase_order_id',
        'process_day',
        'commission',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
