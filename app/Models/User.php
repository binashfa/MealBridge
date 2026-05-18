<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [

        'username',
        'email',
        'no_telp',
        'password',
        'role',
        'profile_photo',

    ];

    protected $hidden = [
        'password'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function community()
    {
        return $this->hasOne(Community::class);
    }
}