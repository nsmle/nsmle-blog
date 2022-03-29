<?php

namespace App\Http\Livewire\Pages\Dashboard\Post;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tags;
use App\Models\PostTags;
use App\Models\Notifications;
use App\Events\NotifyEvent;


class Create extends Component
{
    use WithFileUploads;
    
    public $replyToPost;
    
    public $judul;
    public $slug;
    public $category_id;
    public $cover;
    public $konten;
    public $published;
    
    public $createTag;
    public $createTagSlug;
    
    public $rules = [
        'judul' => 'required|string|min:6|max:500',
        'slug' => 'required|string|min:6|max:500|unique:posts',
        'konten' => 'required|string|min:12',
        'cover' => 'image|max:2048',
    ];
    
    public $listeners = ["cancelReplyPost" => "cancelReplyPost"];
    
    public function cancelReplyPost()
    {
        $this->replyToPost = null;
        session()->forget('reply');
        $this->dispatchBrowserEvent("cancel-reply-post", ["status" => "canceled"]);
    }
    
    
    public function updatedCover()
    {
        $this->validate([
            'cover' => $this->rules['cover']
        ]);
    }
    
    public function updatedJudul()
    {
        $this->validate([
            'judul' => $this->rules['judul']
        ]);
    }
    
    public function updatedSlug()
    {
        $this->validate([
            'slug' => $this->rules['slug']
        ]);
    }
    
    public function updatedKonten()
    {
        $this->validate([
            'konten' => $this->rules['konten']
        ]);
    }
    
    public function store($data)
    {
        
        $validated = $this->validate($this->rules);
        
        $coverName = $this->cover->hashName();
        $parentPost = (!empty($this->replyToPost)) ? $this->replyToPost['id'] : null;
        
        $post = [
            'parent_id' => $parentPost,
            'user_id' => Auth::user()->id,
            'category_id' => $this->category_id,
            'title' => $this->judul,
            'slug' => $this->slug,
            'cover' => 'storage/posts-cover/'.$coverName,
            'summary' => Str::words($this->konten, 10,'...'),
            'content' => $this->konten
        ];
        
        if ($this->published === 'true') {
            $post['published'] = $this->published === 'true' ? 1 : 0;
            $post['published_at'] = now();
        }
        
        
        $createdPost = Post::create($post);
        
        if (!empty($data['tags'])) {
            
            foreach (explode(',', $data['tags']) as $tagId) {
                    $tags = [
                        'post_id'   => $createdPost->id,
                        'tags_id' => $tagId
                    ];
                    PostTags::create($tags);
            }
        }
        
        $this->cover->storeAs('posts-cover', $coverName);
        
        $this->createAndDispatchNotifPostReply($createdPost);
        
        return redirect()->to(route('dashboard.post.index'))->with("toastStatus", "Postingan berhasil ditambahkan.");
    }
    
    public function createAndDispatchNotifPostReply(Post $post)
    {
        if (!empty($this->replyToPost) && Auth::id() !== $this->replyToPost['user']['id']) {
            // Create Notification
            Notifications::updateOrCreate([
                'user_id' => $this->replyToPost['user']['id'],
                'trigger_user_id' => Auth::id(),
                'entity_id' => $post->id,
                'entity_type' => 'post',
                'entity_event_id' => $post->id,
                'entity_event_type' => "reply"
            ]);
            
            // Dispatch Notifications
            broadcast(new NotifyEvent(
                $this->replyToPost['user']['id'],
                'post-reply',
                [
                    'status' => "reply",
                    'time' => now()
                ],
                [
                    'post' => $post,
                    'reply_post' => $this->replyToPost,
                    'trigger_user' => Auth::user(),
                ]
            ))->toOthers();
        }
    }
    
    
    public function saveTag()
    {
        
        $tag = [
            'creator_id' => Auth::user()->id,
            'name' => $this->createTag,
            'slug' => $this->createTagSlug
        ];
        
        $validatedTag = Validator::make($tag, [
            'creator_id' => 'required',
            'name' => 'required|unique:tags|min:3|max:18',
            'slug' => 'required|unique:tags'
        ])->validate();
        
        Tags::create($validatedTag);
        
        $this->emit('tag-created');
        $this->dispatchBrowserEvent('tag-created', ['status' => 'success', 'data' => $validatedTag]);
    }
    
    
    public function createSlug($title)
    {
        //$this->post['title'] = $title;
        $this->slug = SlugService::createSlug(Post::class, 'slug', $title);
    }
    
    public function createSlugTag($tagName)
    {
        $this->createTagSlug = SlugService::createSlug(Tags::class, 'slug', $tagName);
    }
    
    public function mount(Request $request)
    {
        if ($request->session()->exists('reply')) {
            $this->replyToPost = session('reply');
        }
    }
    
    
    public function render()
    {
        return view('livewire.pages.dashboard.post.create', [
            'allCategories' => Category::all(),
            'allTags' => Tags::latest()->get()
        ]);
    }
}
