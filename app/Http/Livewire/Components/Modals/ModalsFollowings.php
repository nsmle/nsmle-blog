<?php

namespace App\Http\Livewire\Components\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use App\Events\NotifyEvent;
use App\Events\UserEvent;
use Auth;

class ModalsFollowings extends ModalComponent
{
    public $user;
    
    private $followings;
    
    public $perPage = 20;
    
    public $pageMode;
    
    public function loadMore()
    {
        $this->perPage += 20;
        $this->updateData();
    }
    
    public function follow($followingId)
    {
        $userForFollow = User::find($followingId);
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
        $this->followings = $this->user->followings($this->perPage);
    }
    
    
    public function mount($user, $pageMode)
    {
        $this->user = User::find($user['id']);
        $this->pageMode = $pageMode;
        $this->updateData();
    }
    
    
    public function render()
    {
        return view('livewire.components.modals.modals-followings', [
            'user' => $this->user,
            'followings' => $this->followings
        ]);
    }
}
