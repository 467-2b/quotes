<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $connection = 'legacydb';
    protected $table = 'customers';
    public $timestamps = false;

    /**
     * Get the quotes from the customer
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
