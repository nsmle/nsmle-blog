<?php

namespace App\Http\Livewire\Pages\Profile;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use Auth;
use Livewire\WithPagination;

//use App\Events\UserStatus;
use App\Events\NotifyEvent;

class Show extends Component
{
    use WithPagination;
    
    public $user;
    
    protected $posts;
    
    public $usernameUser;
    
    public $follow, $alert;
    
    public $showPostPublishedOnly = true;
    
    public $perPage = 10;
    
    public function getListeners()
    {
        return [
            "echo-private:notify-event.".Auth::id().",.user-follow" => 'updateDataUser',
            'user.follow' => 'updateDataUser',
            'echo:user-status,.status' => 'userStatus'
        ];
    }
    
    public function userStatus($data)
    {
        $this->updateDataUser();
        //dd($data);
    }
    
    public function follow()
    {
        if (!Auth::check()) {
            $this->updateDataUser();
            return $this->emit(
                "openModal",
                "components.modals.modals-login",
                [
                    'redirectAfterLogin' => "/{$this->user->username}",
                    "message" => "Anda harus login untuk mengikuti {$this->user->name}.",
                ]
            );
        }
        
        $followStatus = $this->user->createOrDeleteFollower(Auth::user());
        
        // Send Notification
        broadcast(new NotifyEvent(
            $this->user->id,
            "user-follow",
            [
                'status' => $followStatus,
                'time' => now()
            ],
            [
                'user' => $this->user,
                'follower' => Auth::user()
            ]
        ))->toOthers();
        
        
        $this->updateDataUser();
    }
    
    public function sendMessage()
    {
        dd("send message");
    }
    
    
    public function loadMorePost()
    {
        $this->perPage = $perPage;
        $this->updateDataUser();
    }
    
    public function changeShowPostByStatus($showPostPublishedOnly)
    {
        $this->reset('perPage');
        $this->showPostPublishedOnly = $showPostPublishedOnly;
        $this->updateDataUser();
    }
    
    
    public function updateDataUser()
    {
        $this->user =  User::where('username', $this->usernameUser)
                           ->first();
        
        if (!$this->user) {
            abort(404);
        }
        
        $this->posts = $this->user
                            ->posts()
                            ->where('published', $this->showPostPublishedOnly)
                            ->orderBy("published_at", "DESC")
                            ->paginate($this->perPage, ['*'], null, 1);
    }
    
    public function mount(Request $request)
    {
        $this->usernameUser = $request->username;
        $this->updateDataUser();
    }
    
    public function render()
    {
        return view('livewire.pages.profile.show', [
            'user' => $this->user,
            'follow' => $this->follow,
            'posts' => $this->posts,
            'alert' => $this->alert,
        ])->layout((Auth::check()) ? 'layouts.app' : 'layouts.guest');
        
    }
}
