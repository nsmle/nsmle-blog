<?php

namespace App\Http\Livewire\Components\PostAction;

use Livewire\Component;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\Notifications;
use App\Events\PostEvent;
use App\Events\NotifyEvent;
use Auth;

class Like extends Component
{
    
    public Post $post;
    
    public $postId;
    
    public $postLikes;
    
    public $isLiked;
    
    public $isPagePost;
    
    
    public function getListeners()
    {
        return [
            "echo-private:notify-event.".Auth::id().",.post-like" => 'postLiked',
            "echo:post-event,.post-like" => 'postLiked',
        ];
    }
    
    public function postLiked($data)
    {
        if ($data['data']['post']['slug'] === $this->post->slug) {
            $this->refreshData();
        }
    }
    
    public function like()
    {
        if (Auth::check()) {
            
            $postLikeStatus = $this->post->createOrDeletePostLike(Auth::user());
            
            if (Auth::id() !== $this->post->user->id) {
                // Dispatch Notifications
                broadcast(new NotifyEvent(
                    $this->post->user->id,
                    'post-like',
                    [
                        'status' => $postLikeStatus,
                        'time' => now()
                    ],
                    [
                        'post' => $this->post,
                        'trigger_user' => Auth::user(),
                    ]
                ))->toOthers();
                
            }
            // Dispatch PostEvent For No Authentication
            broadcast(new PostEvent('post-like', $this->post->slug))->toOthers();
            
            $this->refreshData();
        } else {
            $this->emit(
                "openModal",
                "components.modals.modals-login",
                [
                    'redirectAfterLogin' => "/posts/{$this->post->slug}",
                    "message" => "Anda harus login untuk menyukai postingan ini.",
                ]
            );
        }
    }
    
    
    public function refreshData()
    {
        // Update data post
        $this->post = Post::find($this->postId);
        
        // Update data post likes
        $this->postLikes = $this->post->like;
        
        if (Auth::check()) {
            $this->isLiked = $this->post
                                  ->isLiked(Auth::user());
        } else {
            $this->isLiked = null;
        }
    }
    
    public function mount(Post $post)
    {
        $this->postId = $post->id;
        $this->refreshData();
        $this->isPagePost = (request()->routeIs('dashboard.post.*') || request()->routeIs('post.*')) ? true : false;
    }
    
    public function render()
    {
        return view('livewire.components.post-action.like',[
            'postLikes' => $this->postLikes,
            'isLiked' => $this->isLiked
        ]);
    }
}
