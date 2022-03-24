<?php

namespace App\Http\Livewire\Pages\Profile;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
// use Livewire\WithPagination;

//use App\Events\UserStatus;
use App\Events\NotifyEvent;

class Show extends Component
{
    // use WithPagination;
    
    public $user;
    
    protected $posts;
    
    public $usernameUser;
    
    public $showPostPublishedOnly = true;
    
    public $perPage = 1;
    
    public function getListeners()
    {
        return [
            "echo-private:notify-event.".Auth::id().",.user-follow" => 'updateDataUser',
            'user.follow' => 'updateDataUser',
            'echo:user-status,.status' => 'userStatus'
        ];
    }
    
    public function getFollowers()
    {
        $this->emit(
            "openModal",
            "components.modals.modals-followers",
            [
                'user' => $this->user,
                'pageMode' => request()->mode,
            ]
        );
        
        $this->updateDataUser();
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
        $this->perPage += 1;
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
        $this->user =  User::where('username', $this->tempUsername)
                           ->first();
        
        $this->posts = $this->user->postsNew(
            $this->showPostPublishedOnly,
            $this->perPage
        );
    }
    
    public function mount(User $user)
    {
        // define user from route model binding
        $this->user = $user;
        $this->tempUsername = $user->username;
        
        // get user posts
        $this->posts = $this->user->postsNew(
            $this->showPostPublishedOnly,
            $this->perPage
        );
    }
    
    
    public function render()
    {
        return view('livewire.pages.profile.show', [
            'user' => $this->user,
            'posts' => $this->posts,
        ])->layout(
            (Auth::check())
                ? 'layouts.app'
                : 'layouts.guest'
        );
    }
}
