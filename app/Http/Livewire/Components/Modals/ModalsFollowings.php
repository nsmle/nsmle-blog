<?php

namespace App\Http\Livewire\Components\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use App\Models\Follower;
use Auth;

class ModalsFollowings extends ModalComponent
{
    public User $user;
    
    private $followings;
    
    public $perPage = 20;
    
    public $pageMode;
    
    public function loadMore()
    {
        $this->perPage += 20;
        $this->updateData();
    }
    
    public function follow($idUserWillFollow)
    {
        $userWillFollow = User::find($idUserWillFollow);
        
        if (!empty($userWillFollow)) {
            $followed = $userWillFollow->followers()
                                       ->where('follower_id', Auth::id())
                                       ->first();
            
            if (empty($followed)) {
                Follower::create([
                    'user_id' => $userWillFollow->id,
                    'follower_id' => Auth::id()
                ]);
                $followStatus = 'follow';
            } else {
                $follow = Follower::where('user_id', $userWillFollow->id)
                                  ->where('follower_id', Auth::id())
                                  ->first();
                
                $follow->delete();
                $followStatus = "unfollow";
            }
        }
        
        return $this->updateData();
    }
    
    public function updateData()
    {
        $this->followings = $this->user
                                ->followings()
                                ->paginate($this->perPage, ['*'], null, 1);
    }
    
    
    public function mount(User $user, $pageMode)
    {
        $this->user = $user;
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
