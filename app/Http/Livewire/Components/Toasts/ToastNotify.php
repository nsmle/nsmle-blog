<?php

namespace App\Http\Livewire\Components\Toasts;

use Livewire\Component;
use Auth;

class ToastNotify extends Component
{
    private $toastNotifyUserFollowed;
    
    private $toastNotifyPostReplied;
    
    private $toastNotifyPostLiked;
    
    private $toastNotifyPostCommented;
    
    public function getListeners()
    {
        return [
            'clearDataToastNotify' => 'clearDataToastNotify',
            "echo-private:notify-event.".Auth::id().",.post-reply" => 'toastNotifyPostReplied',
            "echo-private:notify-event.".Auth::id().",.post-like" => 'toastNotifyPostLiked',
            "echo-private:notify-event.".Auth::id().",.post-comment" => 'toastNotifyPostCommented',
            "echo-private:notify-event.".Auth::id().",.user-follow" => 'toastNotifyUserFollow',
        ];
    }
    
    public function clearDataToastNotify()
    {
        $this->toastNotifyUserFollowed = null;
        $this->toastNotifyPostReplied = null;
        $this->toastNotifyPostLiked = null;
        $this->toastNotifyPostCommented = null;
    }
    
    public function toastNotifyUserFollow($dataUserFollowed)
    {
        $this->toastNotifyUserFollowed = [
            'info' => $dataUserFollowed['info'],
            'user' => $dataUserFollowed['data']['user'],
            'follower' => $dataUserFollowed['data']['follower']
        ];
    }
    
    public function toastNotifyPostReplied($dataPostReply)
    {
        $this->toastNotifyPostReplied = [
            'info' => $dataPostReply['info'],
            'post' => $dataPostReply['data']['post'],
            'reply_post' => $dataPostReply['data']['reply_post'],
            'trigger_user' => $dataPostReply['data']['trigger_user']
        ];
    }
    
    public function toastNotifyPostCommented($dataPostCommented)
    {
        $this->toastNotifyPostCommented = [
            'info' => $dataPostCommented['info'],
            'post' => $dataPostCommented['data']['post'],
            'comment' => $dataPostCommented['data']['comment'],
            'trigger_user' => $dataPostCommented['data']['trigger_user']
        ];
    }
    
    public function toastNotifyPostLiked($dataPostLiked)
    {
        //dd($dataPostLiked);
        if ($dataPostLiked['info']['status'] === 'like' && Auth::id() === $dataPostLiked['data']['post']['user']['id']) {
            $this->toastNotifyPostLiked = null;
            $this->toastNotifyPostLiked = [
                'info' => $dataPostLiked['info'],
                'post' => $dataPostLiked['data']['post'],
                'trigger_user' => $dataPostLiked['data']['trigger_user']
            ];
        }
    }
    
    public function render()
    {
        
        return view('livewire.components.toasts.toast-notify', [
            'toastNotifyUserFollowed' => $this->toastNotifyUserFollowed,
            'toastNotifyPostReplied' => $this->toastNotifyPostReplied,
            'toastNotifyPostLiked' => $this->toastNotifyPostLiked,
            'toastNotifyPostCommented' => $this->toastNotifyPostCommented
        ]);
    }
}
