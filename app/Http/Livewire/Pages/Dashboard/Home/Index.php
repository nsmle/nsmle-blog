<?php

namespace App\Http\Livewire\Pages\Dashboard\Home;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Events\NotifyEvent;
use App\Events\UserEvent;
use Auth;

class Index extends Component
{
    protected $posts;
    
    public $perPage = 6;
    public $addPerPage = 3;
    
    public function loadMorePost()
    {
        $this->perPage += $this->addPerPage;    
        $this->updatedDataPost();
    }
    
    public function follow($userId)
    {
        if (!Auth::check()) {
            $this->updatedDataPost();
            return $this->emit(
                "openModal",
                "components.modals.modals-login",
                [
                    'redirectAfterLogin' => "/{$user->username}",
                    "message" => "Anda harus login untuk mengikuti {$user->name}.",
                ]
            );
        }
        
        $user = User::find($userId);
        
        $followStatus = $user->createOrDeleteFollower(Auth::user());
        
        // Send Notification to target user
        broadcast(new NotifyEvent(
            $user->id,
            "user-follow",
            [
                'status' => $followStatus,
                'time' => now()
            ],
            [
                'user' => $user,
                'follower' => Auth::user()
            ]
        ))->toOthers();
        
        // Send Notification to all guest/user for refreshed data
        UserEvent::dispatch('user-follow', $user->username);
        
        $this->updatedDataPost();
    }
    
    public function replyPost($post)
    {
        $replyPost =  collect([
            'id' => $post['id'],
            'title' => $post['title'],
            'slug' => $post['slug'],
            'cover' => $post['cover'],
            'user' => [
                'id' => $post['user']['id'],
                'name' => $post['user']['name'],
                'username' => $post['user']['username']
            ]
        ]);
        
        return redirect()->to(route('dashboard.post.create'))->with(['reply' => $replyPost]);
    }
    
    public function updatedDataPost()
    {
        $this->posts = Post::latest()->where('published', true)->cursorPaginate($this->perPage);
    }
    
    public function mount()
    {
        $this->updatedDataPost();
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.home.index', [
            'posts' => $this->posts
        ]);
    }
}
