<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    
    public $guarded = ['id'];
    
    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }
}
