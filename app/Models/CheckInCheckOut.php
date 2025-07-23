<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckInCheckOut extends Model
{

        use HasFactory;

    protected $guarded = [
        'user_id',
        'checkin_time',
        'checkout_time',
        'date'
    ];

    public function employee(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
