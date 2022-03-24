<?php

namespace App\Http\Livewire\Components\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use App\Events\NotifyEvent;
use App\Events\UserEvent;
use Auth;

class ModalsFollowers extends ModalComponent
{
    public $user;
    
    private $followers;
    
    public $perPage = 20;
    
    public $pageMode;
    
    public function loadMore()
    {
        $this->perPage += 20;
        $this->updateData();
    }
    
    public function follow($followerId)
    {
        $userForFollow = User::find($followerId);
        $followStatus = $userForFollow->createOrDeleteFollower(Auth::user());
        
        // Send Notification to target User
        broadcast(new NotifyEvent(
            $userForFollow->id,
            "user-follow",
            [
                'status' => $followStatus,
                'time' => now()
            ],
            [
                'user' => $userForFollow,
                'follower' => Auth::user()
            ]
        ))->toOthers();
        
        // Send Notification to all guest/user for refreshed data
        UserEvent::dispatch('user-follow', $this->user->username);
        
        return $this->updateData();
    }
    
    public function updateData()
    {
        $this->followers = $this->user->followers($this->perPage);
    }
    
    
    public function mount($user, $pageMode)
    {
        $this->user = User::find($user['id']);
        $this->pageMode = $pageMode;
        $this->updateData();
    }
    
    public function render()
    {
        return view('livewire.components.modals.modals-followers', [
            'user' => $this->user,
            'followers' => $this->followers
        ]);
    }
}
