<?php

namespace App\Http\Livewire\Pages\Dashboard\Notification;

use Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Notifications;

class Index extends Component
{
    use WithPagination;
    
    private $notifications;
    
    public $unreadNotifications;
    
    public $perPage = 20;
    
    public function getListeners()
    {
        return [
            "echo-private:notify-event.".Auth::id().",.post-like" => 'getUpdateNotifications',
            "echo-private:notify-event.".Auth::id().",.post-comment" => 'getUpdateNotifications',
        ];
    }
    
    public function loadMore()
    {
        $this->perPage += 20;
        $this->getUpdateNotifications();
    }
    
    public function readNotif($notifId, $redirect)
    {
        $notif = Notifications::find($notifId);
        if (!empty($notif)) {
            $notif->update([
                'read' => true,
                'read_at' => now()
            ]);
            
            redirect()->to($redirect);
        }
    }
    
    public function readAllUnreadNotif()
    {
        Notifications::where('user_id', Auth::id())->where('read', false)->update([
            'read' => true,
            'read_at' => now()
        ]);
        $this->getUpdateNotifications();
        $this->emit('readAllUnreadNotif');
    }
    
    public function getUpdateNotifications()
    {
        $this->notifications = Notifications::where('user_id', Auth::id())
                                            ->orderBy('created_at', 'DESC')
                                            ->with(['user', 'post', 'comment'])
                                            ->paginate($this->perPage, ['*'], null, 1);
        
        $this->unreadNotifications = Notifications::where('user_id', Auth::id())
                                                  ->where('read', false)
                                                  ->get();
    }
    
    public function mount()
    {
        $this->getUpdateNotifications();
    }
    
    public function render()
    {
        //dd($this->notifications);
        return view('livewire.pages.dashboard.notification.index', [
            'notifications' => $this->notifications,
            'unreadNotifications' => $this->unreadNotifications,
        ]);
    }
}
