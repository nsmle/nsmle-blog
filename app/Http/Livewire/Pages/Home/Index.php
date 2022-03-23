<?php

namespace App\Http\Livewire\Pages\Home;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;

class Index extends Component
{
    protected $posts;
    
    protected $categories;
    
    public $listenenrs = [
        'seeAllPosts',
        'seeAllCategory'
    ];
    
    public function seeAllPosts()
    {
        return redirect()->to('post');
    }
    
    public function seeAllCategory()
    {
        return redirect()->to('post?category=all');
    }
    
    public function mount()
    {
        $this->posts = Post::where('published', true)
                          ->with('category', 'user', 'tags')
                          ->orderBy('published_at', 'desc')
                          ->limit(10)
                          ->get();
                          
        $this->categories = Category::whereNotNull("name")
                                    ->orderBy('created_at', 'desc')
                                    ->with('posts')
                                    ->limit(6)
                                    ->get();
    }
    public function render()
    {
        //dd($this->categories[0]->posts);
        return view('livewire.pages.home.index', [
            'posts' => $this->posts,
            'categories' => $this->categories
        ])->layout('layouts.guest');;
    }
}
