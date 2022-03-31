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
    
    public static function boot()
    {
        parent::boot();
        
        static::deleting(function ($post) {
            
            // update all child post
            $post->allChild()->update(["parent_id" => null]);
            
            // Delete all Tags
            $post->tags()->delete();
            
            // Delete all Post Like
            $post->like()->delete();
            
            // Delete all Post Comment
            $post->Comment()->delete();
            
            // Delete Notifications post reply
            $notifPostReply = $post->notifPostReply();
            if (!empty($notifPostReply)) {
                $notifPostReply->delete();
            }
            
            // Delete Cover
            if (!empty($post->cover)) {
                if (\File::exists(public_path($post->cover))) {
                    \File::delete(public_path($post->cover));
                }
            }
        });
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
        return $this->hasMany($this, 'parent_id', 'id')->where('published', true);
    }
    
    public function allChild()
    {
        return $this->hasMany($this, 'parent_id', 'id');
    }
    
    public function notifPostReply()
    {
        return Notifications::where('trigger_user_id', $this->user->id)
                            ->where('entity_id', $this->id)
                            ->where('entity_type', 'post')
                            ->where('entity_event_id', $this->id)
                            ->where('entity_event_type', 'reply')
                            ->first();
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
    
    public function createOrDeletePostLike(User $user)
    {
        $isLiked = $this->isLiked($user);
        if (!empty($isLiked)) {
            $isLiked->delete();
            return 'unlike';
        }
        
        
        PostLike::create([
            'user_id' => $user->id,
            'post_id' => $this->id
        ]);
        return 'like';
    }
    
}
