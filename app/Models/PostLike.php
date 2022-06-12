<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public static function boot()
    {
        parent::boot();
        
        static::created(function (PostLike $postLiked) {
            $postLiked->createOrDeleteNotifPostLiked(true);
        });
        
        static::deleted(function (PostLike $postLiked) {
            $postLiked->createOrDeleteNotifPostLiked();
        });
    }
    
    
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function createOrDeleteNotifPostLiked(bool $isCreatePostLike = false): void
    {
        if ($isCreatePostLike) {
            Notifications::create([
                'user_id'           => $this->post->user->id,
                'trigger_user_id'   => $this->user->id,
                'entity_id'         => $this->post->id,
                'entity_type'       => 'post',
                'entity_event_id'   => $this->id,
                'entity_event_type' => 'like'
            ]);
        } else {
            $postLiked = Notifications::where('user_id', $this->post->user->id)
                                  ->where('trigger_user_id', $this->user->id)
                                  ->where('entity_id', $this->post->id)
                                  ->where('entity_type', 'post')
                                  ->where('entity_event_id', $this->id)
                                  ->where('entity_event_type', 'like')
                                  ->first();
            $postLiked->delete();
        }
    }
}
