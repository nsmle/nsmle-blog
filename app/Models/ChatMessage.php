<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ChatMessage extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->hasMany(User::class);
    }
    
    public function scopeRoom($id)
    {
        return ChatMessage::where('user_id', Auth::id())
            ->where('to_user_id', $id);
        dd($this->user);
    }
}
