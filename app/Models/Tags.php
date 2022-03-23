<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Cviebrock\EloquentSluggable\Sluggable;

class Tags extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $fillable = ['name', 'slug', 'creator_id'];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '-',
                'unique' => true
            ]
        ];
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
