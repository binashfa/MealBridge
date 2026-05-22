<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationClaim extends Model
{
    protected $table = 'donation_claims';

    protected $fillable = [

        'donation_id',
        'community_id',

        'claimed_quantity',

        'status',

        // COMMUNITY
        'proof_photo',

        // SUPPLIER
        'supplier_proof_photo',

        'delivery_date',

        'courier_name',

        'courier_phone',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}