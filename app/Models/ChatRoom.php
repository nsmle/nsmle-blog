<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ChatRoom extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function scopeGetRoomByUser(int $userId)
    {
        return $this->where('');
    }
    
    public function user()
    {
        if (Auth::id() == $this->user_id_1) {
            return ($this->belongsTo(User::class, 'user_id_2'));
        } else {
            return ($this->belongsTo(User::class, 'user_id_1'));
        }
    }
    
    public function getLatestChat()
    {
        return $this->hasMany(ChatMessage::class)->latest()->first();
    }
    
    public function readAllUnreadMessage(): void
    {
        ChatMessage::where('chat_room_id', $this->id)->where('read', false)->where('user_id', $this->user->id)->update([
            'read' => true,
            'read_at' => now()
        ]);
    }
    
    public function unreadMessage($userId = null)
    {
        if (!empty($userId)) {
            return ChatMessage::where('chat_room_id', $this->id)->where('user_id', $userId)->where('read', false)->get();
        }
        return ChatMessage::where('chat_room_id', $this->id)->where('read', false)->get();
    }
    
    public function chats()
    {
        
        return $this->hasMany(ChatMessage::class);
    }
}
