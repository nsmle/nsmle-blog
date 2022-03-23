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
}
