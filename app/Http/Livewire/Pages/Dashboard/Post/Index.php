<?php

namespace App\Http\Livewire\Pages\Dashboard\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\PostTags;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use File;

use Livewire\WithPagination;

class Index extends Component
{
    
    use WithPagination;
    
    protected $posts;
    
    public $search;
    
    public $searchBy = 'title';
    
    public $perPage = 10;
    
    protected $listeners = ['deletePost' => 'deletePost'];
    
    public function deletePost($id, $slug, $title)
    {
        $post = Post::find($id);
        if (!empty($post)) {
            $post->delete();
        }
        
        $this->dispatchBrowserEvent('postDeleted', [ 'id' => $id, 'slug' => $slug, 'title' => $title ]);
    }
    
    public function createNewPost()
    {
        return redirect()->to(route('dashboard.post.create'));
    }
    
    public function resetSearch()
    {
        $this->reset('search');
        $this->reset('searchBy');
    }
    
    public function search($searchKey)
    {
        $this->search = $searchKey;
    }
    
    public function render()
    {
        

        if (!empty($this->search) && $this->search !== "\s") {
            $posts = Post::Where('user_id', Auth::user()->id)
                            ->where($this->searchBy,'LIKE','%'.$this->search.'%')
                            ->orderBy('created_at', 'desc')
                            ->get();
        } else {
            $posts = Post::Where('user_id', Auth::user()->id)
                         ->orderBy('created_at', 'desc')
                         ->paginate($this->perPage)
                         ->withQueryString();
        }
        
        
        return view('livewire.pages.dashboard.post.index', [
            'posts' => $posts
        ])->layout('layouts.app');
        
    }
}
