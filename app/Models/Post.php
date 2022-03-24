<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $guarded = ['id'];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'     => 'title',
                'separator'  => '-',
                'unique'     => true,
            ]
        ];
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function parent()
    {
        return $this->belongsTo($this)->where('published', true);
    }
    
    public function child()
    {
        //return $this->hasMany($this, 'parent_id', 'id');
        
        return $this->hasMany($this, 'parent_id', 'id')->where('published', true);
        
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tags::class, PostTags::class);
    }
    
    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function read()
    {
        return $this->hasMany(PostRead::class);
    }
    
    public function like()
    {
        return $this->hasMany(PostLike::class);
    }
    
    public function isLiked(User $user)
    {
        return $this->like->where('user_id', $user->id)->first();
    }
    
    public function createOrDeletePostLike(User $user): string
    {
        $isLiked = $this->isLiked($user);
        
        if (empty($isLiked)) {
            // Create Post Like
            $postLiked = PostLike::create([
                'post_id' => $this->id,
                'user_id' => $user->id
            ]);
            // Status post liked
            $status = "like";
            //Create Notifications
            $this->createOrDeleteNotificationPostLike($status, $user, $postLiked);
        } else {
            // Status post unliked
            $status = "unlike";
            //Create Notifications
            $this->createOrDeleteNotificationPostLike($status, $user, $isLiked);
            //Delete Post like
            $isLiked->delete();
        }
        
        return $status;
    }
    
    
    public function createOrDeleteNotificationPostLike(string $eventType, User $triggerUser, PostLike $postLike): void
    {
        if ($this->user->id !== $triggerUser->id) {
            if ($eventType == 'like') {
                Notifications::updateOrCreate([
                    'user_id' => $this->user->id,
                    'trigger_user_id' => $triggerUser->id,
                    'entity_id' => $this->id,
                    'entity_type' => 'post',
                    'entity_event_id' => $postLike->id,
                    'entity_event_type' => 'like'
                ]);
            } else {
                $notifyPostLiked = Notifications::where('trigger_user_id', $triggerUser->id)
                    ->where('entity_id', $this->id)
                    ->where('entity_type', 'post')
                    ->where('entity_event_id', $postLike->id)
                    ->where('entity_event_type', 'like')
                    ->first();
                
                (!empty($notifyPostLiked)) ? $notifyPostLiked->delete() : '';
            }
        }
    }
}
