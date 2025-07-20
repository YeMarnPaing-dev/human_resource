<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckInCheckOut extends Model
{

        use HasFactory;

    protected $fillable = [
        'user_id',
        'checkin_time',
        'checkout_time',
        'date'
    ];

}
