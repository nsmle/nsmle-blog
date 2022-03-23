<?php

namespace App\Http\Livewire\Pages\Post;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notifications;
use App\Events\PostEvent;
use App\Events\NotifyEvent;
use Auth;

class Show extends Component
{
    
    use AuthorizesRequests;
    
    public $post;
    
    public $tempPostId;
    
    public function getListeners()
    {
        return [
            'deleteComment' => 'deleteComment',
            "echo-private:notify-event.".Auth::id().",.post-comment" => 'updateRendererData',
            "echo:post-event,.post-comment" => 'updateRendererData',
        ];
    }
    
    public function updateRendererData($data)
    {
        if ($this->post->slug == $data['data']['post']['slug']) {
            $this->updateDataPost();
        } 
    }
    
    public function redirectToModalsLogin()
    {
        $this->updateDataPost();
        $this->emit(
            "openModal",
            "components.modals.modals-login",
            [
                'redirectAfterLogin' => "/posts/{$this->post->slug}",
                "message" => "Anda harus login untuk menambahkan komentar.",
            ]
        );
    }
    
    public function replyPost()
    {
        $replyPost =  collect([
            'id' => $this->post->id,
            'title' => $this->post->title,
            'slug' => $this->post->slug,
            'cover' => $this->post->cover,
            'user' => [
                'id' => $this->post->user->id,
                'name' => $this->post->user->name,
                'username' => $this->post->user->username
            ]
        ]);
        
        return redirect()->to(route('dashboard.post.create'))->with(['reply' => $replyPost]);
    }
    
    public function addComment($comment)
    {
        if ( empty($comment['content']) ) {
            return $this->dispatchBrowserEvent('toastStatus', [
                'status' => 'toastDanger',
                'message' => 'Komentar gagal ditambahkan: kolom komentar tidak boleh kosong'
            ]);
        };
        
        $addComment = [
            'user_id'     => Auth::id(),
            'post_id'     => $comment['post']['id'],
            'parent_id'   => $comment['parent_id'],
            'reply_to_id' => $comment['reply_to'],
            'content'     => $comment['content']
        ];
        
        // Insert Comment
        $comment = Comment::create($addComment);
        
        $this->dispatchBrowserEvent('toastStatus', [
            'status' => 'toastSuccess',
            'message' => 'Komentar berhasil di tambahkan'
        ]);
        
        
        if (Auth::id() !== $this->post->user->id) {
            // Insert Notification
            Notifications::updateOrCreate([
                'user_id' => $this->post->user->id,
                'trigger_user_id' => Auth::id(),
                'entity_id' => $this->post->id,
                'entity_type' => 'post',
                'entity_event_id' => $comment->id,
                'entity_event_type' => "comment"
            ]);
            
            // Dispatch Notifications
            broadcast(new NotifyEvent(
                $this->post->user->id,
                'post-comment',
                [
                    'status' => "comment",
                    'time' => now()
                ],
                [
                    'post' => $this->post,
                    'comment' => $comment,
                    'trigger_user' => Auth::user(),
                ]
            ))->toOthers();
        }
        
        // Dispatch PostEvent For No Authentication
        broadcast(new PostEvent('post-comment', $this->post->slug))->toOthers();
        
        $this->updateDataPost();
    }
    
    public function editComment($comment)
    {
        
        if ( empty($comment['content']) ) {
            return $this->dispatchBrowserEvent('toastStatus', [
                'status' => 'toastDanger',
                'message' => 'Komentar gagal di edit: kolom komentar tidak boleh kosong'
            ]);
        };
        
        $commentar = Comment::find($comment['comment_id']);
        $commentar->content = $comment['content'];
        $commentar->save();
        
        $this->dispatchBrowserEvent('toastStatus', [
            'status' => 'toastSuccess',
            'message' => 'Komentar berhasil di edit'
        ]);
        
        $this->updateDataPost();
    }
    
    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        $childComment = Comment::where('parent_id', $commentId)->get();
        $replyComment = Comment::where('reply_to_id', $commentId)->get();
        
        
        // Delete Child Comment
        if ($childComment->isNotEmpty()) {
            $childComment->map(function ($child) use ($comment) {
                $child->timestamps = false;
                ($child->reply_to_id !== null && $child->reply_to_id !== $comment->id) ? $child->parent_id = $child->reply_to_id : $child->parent_id = null;
                $child->save(['status' => 'Unallocated']);
            });
        }
        
        // Delete Reply Comment
        if ($replyComment->isNotEmpty()) {
            $replyComment->map(function ($reply) use ($comment) {
                $reply->timestamps = false;
                ($reply->reply_to_id === $comment->id) ? $reply->reply_to_id = null : $reply->reply_to_id = $reply->parent_id;
                $reply->save(['status' => 'Unallocated']);
            });
        }
        
        // Delete Comment
        $comment->delete();
        
        // Delete Notifications
        $notification = Notifications::where('trigger_user_id', Auth::id())
                     ->where('entity_id', $this->post->id)
                     ->where('entity_type', 'post')
                     ->where('entity_event_id', $commentId)
                     ->where('entity_event_type', 'comment')
                     ->first();
        if (!empty($notification)) {
            
            $notification->delete();
            
            broadcast(new NotifyEvent(
                $this->post->user->id,
                'post-comment',
                [
                    'status' => "uncomment",
                    'time' => now()
                ],
                [
                    'post' => $this->post,
                    'comment' => $comment,
                    'trigger_user' => Auth::user(),
                ]
            ))->toOthers();
            
            // Dispatch PostEvent For No Authentication
            broadcast(new PostEvent('post-comment', $this->post->slug))->toOthers();
        }
        
        $this->dispatchBrowserEvent('toastStatus', [
            'status' => 'toastSuccess',
            'message' => 'Komentar berhasil di hapus'
        ]);
        
        $this->updateDataPost();
    }
    
    public function updateDataPost()
    {
        $this->post = Post::find($this->tempPostId);
    }
    
    public function mount(Post $post)
    {
        if (!$post->published) {
            Auth::check() ? (Auth::user()->id !== $post->user_id ? abort(401) : '') : abort(401);
        }
        
        $this->post = $post;
        $this->tempPostId = $post->id;
    }
    
    
    public function render()
    {
        return view('livewire.pages.post.show', [
            'post' => $this->post
        ])->layout((Auth::check()) ? 'layouts.app' : 'layouts.guest');
    }
}
