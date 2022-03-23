<?php

namespace App\Http\Livewire\Pages\Dashboard\Post;

use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Tags;
use App\Models\Category;
use App\Models\PostTags;
use File;

class Edit extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    
    public Post $post;
    
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
        'slug' => 'required|string|min:6|max:500',
        'konten' => 'required|string|min:12',
        'cover' => 'image|max:2048',
    ];
    
    public $listeners = ['cancelReplyPost'];
    
    public function cancelReplyPost()
    {
        $this->replyToPost = null;
        $this->dispatchBrowserEvent('cancel-reply-post', ['status' => 'canceled']);
    }
    
    public function redirectToDashboardPost()
    {
        return redirect()->to(route('dashboard.post.index'));
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
        $rulesSlug = 'required|string|min:6|max:500';
        
        if ($this->slug !== $this->post->slug) {
            $rulesSlug .= '|unique:posts';
        }
        
        $this->validate([
            'slug' => $rulesSlug
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
        
        //dd($data['tags']);
        $this->authorize('update', $this->post);
        
        $rules = $this->rules;
        if ($this->slug === $this->post->slug) {
            $rules['slug'] = 'required|string|min:6|max:500';
        }
        
        if ($this->post->cover == null || $this->cover == null) {
            $rules['cover'] = 'required|'.$this->rules['cover'];
        } else if ($this->cover === $this->post->cover) {
            $rules['cover'] = 'max:2048';
        }
        
        $validated = $this->validate($rules);
        
        $post = [
            'parent_id' => (!empty($this->replyToPost)) ? $this->replyToPost->id : null,
            'user_id' => Auth::user()->id,
            'category_id' => $this->category_id,
            'title' => $this->judul,
            'slug' => $this->slug,
            'summary' => Str::words($this->konten, 20,'...'),
            'content' => $this->konten
        ];
        
        if ($this->cover !== $this->post->cover) {
            if (File::exists(public_path($this->post->cover))) {
                File::delete(public_path($this->post->cover));
            }
        
            $coverName = $this->cover->storeAs('posts-cover', $this->cover->hashName());
            $this->post->cover = 'storage/'.$coverName;
        }
        
        
        if ($this->published > 0) {
            $this->post->published_at = now();
            $this->post->published = $this->published;
        } else {
            $this->post->published_at = null;
            $this->post->published = (Int) $this->published;
        }
        
        
        // Update Post
        $this->post->parent_id = $post['parent_id'];
        $this->post->user_id = $post['user_id'];
        $this->post->category_id = $post['category_id'];
        $this->post->title = $post['title'];
        $this->post->slug = $post['slug'];
        $this->post->summary = $post['summary'];
        $this->post->content = $post['content'];
        $this->post->save();
        
        
        if (!empty($data['tags'])) {
            
            $postTags = [];
            foreach (explode(',', $data['tags']) as $tagId) {
                array_push($postTags, (Int)$tagId);
            }
            
            $tags = PostTags::where('post_id', $this->post->id)->get();
            $oldesPostTags = [];
            foreach ($tags as $oldPostTag) {
                array_push($oldesPostTags, $oldPostTag->tags_id);
            }
            
            sort($oldesPostTags);
            sort($postTags);
            
            $addTags = array_diff($postTags, $oldesPostTags);
            $deletedTags = array_diff($oldesPostTags, $postTags);
            
            if (!empty($deletedTags)) {
                foreach ($deletedTags as $tagId) {
                    $deleteTag = PostTags::where('post_id', $this->post->id)->where('tags_id', $tagId)->delete();
                }
            }
            
            if (!empty($addTags)) {
                foreach ($addTags as $tagId) {
                    $tag = [
                        'post_id' => $this->post->id,
                        'tags_id' => $tagId
                    ];
                    PostTags::create($tag);
                }
            }
            
        }
        
        return redirect()->to(route('dashboard.post.index'))->with("toast_success", "Postingan berhasil di perbarui.");
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
    
    public function mount()
    {
        $this->authorize('update', $this->post);
        //dd($this->post->tag);
        $this->judul = $this->post->title;
        $this->slug = $this->post->slug;
        $this->category_id = $this->post->category_id;
        $this->published = $this->post->published;
        $this->cover = $this->post->cover;
        $this->konten = $this->post->content;
        
        $this->replyToPost = $this->post->parent;
        //dd($this->replyToPost);
    }
    
    public function render()
    {
        //dd($this->post->id);
        return view('livewire.pages.dashboard.post.edit', [
            'post' => $this->post,
            'allCategories' => Category::all(),
            'allTags' => Tags::all()
        ]);
    }
    
    
}
