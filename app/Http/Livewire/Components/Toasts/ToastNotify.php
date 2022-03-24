<?php

namespace App\Http\Livewire\Components\Toasts;

use Livewire\Component;
use Auth;

class ToastNotify extends Component
{
    public $toastNotifyPostLiked;
    
    public $toastNotifyPostCommented;
    
    public function getListeners()
    {
        return [
            "echo-private:notify-event.".Auth::id().",.post-like" => 'toastNotifyPostLiked',
            "echo-private:notify-event.".Auth::id().",.post-comment" => 'toastNotifyPostCommented',
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
            'toastNotifyPostLiked' => $this->toastNotifyPostLiked,
            'toastNotifyPostCommented' => $this->toastNotifyPostCommented
        ]);
    }
}
