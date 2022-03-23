<?php

namespace App\Http\Livewire\Layouts\Navigations;

use Auth;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Http\Request;

class Notification extends Component
{
    public $notifications;
    
    public $activePage;
    
    public function getListeners()
    {
        return [
            "readAllUnreadNotif" => "updateNotif",
            "echo-private:notify-event.".Auth::id().",.post-like" => 'notificationPost',
            "echo-private:notify-event.".Auth::id().",.post-comment" => 'notificationPost',
        ];
    }
    
    public function updateNotif()
    {
        $this->notifications = $this->getUpdateNotifications();
    }
    
    public function notificationPost()
    {
        $this->notifications = $this->getUpdateNotifications();
    }
    
    public function getUpdateNotifications()
    {
        return Notifications::where('user_id', Auth::id())
                            ->where('read', false)
                            ->get();
    }
    
    /*
    public function updatedNotifications()
    {
        //$this->emitTo('components.button-primary-link');
        $this->notifications = $this->getUpdateNotifications();
        //dd($this->notifications);
    }
    */
    
    public function mount(Request $request)
    {
        $this->activePage = $request->routeIs('dashboard.notification.*');
        $this->notifications = $this->getUpdateNotifications();
    }
    
    public function render()
    {
        return view('livewire.layouts.navigations.notification', [
            'notifications' => $this->notifications
        ]);
    }
}
