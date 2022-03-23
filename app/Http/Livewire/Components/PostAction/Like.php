<?php

namespace App\Http\Livewire\Components\PostAction;

use Livewire\Component;
use App\Models\PostLike;
use App\Models\Notifications;
use Auth;
use App\Events\PostEvent;
use App\Events\NotifyEvent;

class Like extends Component
{
    
    public $post;
    
    public $postId;
    
    public $postLikes;
    
    public $isLiked;
    
    public $isPagePost;
    
    
    public function getListeners()
    {
        if (Auth::check() && Auth::id() === $this->post->user->id) {
            $listeners = [
                "echo-private:notify-event.".Auth::id().",.post-like" => 'postLiked'
            ];
        } else {
            $listeners = [
                "echo:post-event,.post-like" => 'postLiked',
            ];
        }
        
        return $listeners;
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
            
            // Save notifications
            if (Auth::id() !== $this->post->user->id) {
                
                if (!empty($this->isLiked)) {
                    // Delete Post Like
                    $this->isLiked->delete();
                    $status = 'unlike';
                    
                    // Delete Notifications
                    $postLikeNotify = Notifications::where('user_id', $this->post->user->id)
                                                 ->where('entity_id', $this->post->id)
                                                 ->where('entity_type', 'post')
                                                 ->where('entity_event_id', $this->isLiked->id)
                                                 ->where('entity_event_type', 'like')
                                                 ->first();
                    if (!empty($postLikeNotify)) {
                        $postLikeNotify->delete();
                    }
                } else {
                    // Create Post Like
                    $postLike = PostLike::create([
                        'post_id' => $this->postId,
                        'user_id' => Auth::id()
                    ]);
                    
                    $status = 'like';
                    
                    // Create Notification
                    Notifications::updateOrCreate([
                        'user_id' => $this->post->user->id,
                        'trigger_user_id' => Auth::id(),
                        'entity_id' => $this->post->id,
                        'entity_type' => 'post',
                        'entity_event_id' => $postLike->id,
                        'entity_event_type' => 'like'
                    ]);
                }
                
            
            
                // Dispatch Notifications
                NotifyEvent::dispatch(
                    $this->post->user->id,
                    'post-like',
                    [
                        'status' => $status,
                        'time' => now()
                    ],
                    [
                        'post' => $this->post,
                        'trigger_user' => Auth::user(),
                    ]
                );
                
            }
            // Dispatch PostEvent For No Authentication
            PostEvent::dispatch('post-like', $this->post->slug);
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
        $this->postLikes = PostLike::where('post_id', $this->postId)->get();
        
        if (Auth::check()) {
            $this->isLiked = $this->postLikes->where('user_id', Auth::id())->where('post_id', $this->postId)->first();
        } else {
            $this->isLiked = null;
        }
    }
    
    public function mount($post)
    {
        $this->post = $post;
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
