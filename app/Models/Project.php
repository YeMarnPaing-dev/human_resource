<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    protected $casts = [
        'images' => 'array',
        'files' => 'array',
    ];

    public function leaders(){
        return $this->belongToMany(User::class, 'project_leaders', 'project_id', 'user_id');
    }

    public function members(){
        return $this->belongToMany(User::class, 'project_members', 'project_id', 'user_id');
    }
}
