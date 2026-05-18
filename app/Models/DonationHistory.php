<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationHistory extends Model
{
    protected $fillable = [

        'food_name',
        'quantity',
        'distribution_date',
        'volunteer_name',
        'pickup_time',
        'pickup_deadline',
        'distribution_photo',
        'distribution_location',
        'community_receiver',
        'tracking_status',
        'donation_status',

    ];
}