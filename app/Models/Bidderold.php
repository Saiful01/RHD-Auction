<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Bidder extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name','last_name', 'address', 'email', 'password', 'phone', 
        'nid_number', 'tin_number', 'bin_number',
        'photo', 'nid_file', 'tin_file', 'bin_file',
        'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
