<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function triggerUser()
    {
        return $this->belongsTo(User::class, 'trigger_user_id','id');
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class, 'entity_id', 'id');
    }
    
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'entity_event_id', 'id');
    }
    
}
