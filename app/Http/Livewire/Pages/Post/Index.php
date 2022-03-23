<?php

namespace App\Http\Livewire\Pages\Post;

use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tags;

class Index extends Component
{
    use WithPagination;
    
    protected $posts;
    
    public $alert;
    public $perPage;
    public $filters = [];
    
    public function mount(Request $request)
    {
        
        if ($request->get('category')) {
            $category = Category::where('slug', $request->get('category'))->first();
            if ($category) {
                $this->filter('category', $category->id, 'Kategori', $category->name);
            } else {
                session()->flash('alert', "Tidak ada category dengan nama {$request->get('category')}.");
            }
        } else if ($request->get('tag')) {
            $tag = Tags::where('slug', $request->get('tag'))->first();
            if ($tag) {
                $this->filter('tags', $tag->id, 'Tag', $tag->name);
            } else {
                session()->flash('alert', "Tidak ada tag dengan nama {$request->get('tag')}.");
            }
        }
        
        $this->perPage = 10;
    }
    
    public function clearAlert(Request $request)
    {
        $request->session()->forget('alert'); 
    }
    
    public function redirectLogin()
    {
        redirect()->route('login');
    }
    
    public function redirectCreatePost()
    {
        redirect()->route('dashboard.post.create');
    }
    
    public function filter($name, $id, $filterType, $filterName)
    {
        $this->filters = [
            'name' => $name,
            'id' => $id, 
            'filterType' => $filterType,
            'filterName' => $filterName
        ];
    }
    
    public function loadMore($perPage)
    {
        $this->perPage = $perPage;
    }
    
    public function resets()
    {
        $this->filters = [];
    }
    
    public function render()
    {
        if (empty($this->filters) || $this->filters['name'] === "all") {
            $posts = Post::where('published', true)
                                ->orderBy("published_at", "desc")
                                ->with('user', 'category', 'tags')
                                ->paginate($this->perPage, ['*'], null, 1);
        } else {
            if ( $this->filters['name'] === 'category') {
                $posts = Post::where('category_id', $this->filters['id'])
                                ->where('published', true)
                                ->orderBy("published_at", "desc")
                                ->with('user', 'category', 'tags')
                                ->paginate($this->perPage, ['*'], null, 1);
            } else if ( $this->filters['name'] === 'tags') {
                //$posts = Tags::find($this->filters['id'])->post
                 //               ->paginate($this->perPage, ['*'], null, 1);
                $posts = Tags::find($this->filters['id'])->posts()
                                ->with('user', 'category', 'tags')
                                ->paginate($this->perPage, ['*'], null, 1);
            } 
        }
        
        return view('livewire.pages.post.index', [
            'posts' => $posts,
            'categories' => Category::all(),
            'tags' => Tags::all()
        ])->layout('layouts.guest');
    }
}
