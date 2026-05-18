<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [

        'supplier_id',
        'community_id',

        'food_name',
        'quantity',
        'expired_date',
        'description',
        'category',
        'pickup_location',
        'pickup_time',
        'food_photo',
        'proof_photo',
        'status'

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}