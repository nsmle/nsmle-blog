<?php

namespace App\Http\Livewire\Layouts\Navigations;

use Livewire\Component;
use Illuminate\Http\Request;
use Auth;

class Chat extends Component
{
    public $activePage;
    
    public $unreadChats = [];
    
    public $listeners = [
        'echo:user-event,.user-message' => 'userMessage'
    ];
    
    public function userMessage($data)
    {
        if ($data['data']['user']['username'] === Auth::user()->username) {
            $this->getUpdateChats();
        }
    }
    
    public function getUpdateChats()
    {
        $this->unreadChats = [];
        $room = Auth::user()->chatRooms()->map(function ($query) {
            if (!empty($query->unreadMessage($query->user->id))) {
                $this->unreadChats = array_merge($this->unreadChats, $query->unreadMessage($query->user->id)->toArray());
            }
        });
    }
    
    public function mount(Request $request)
    {
        $this->activePage = $request->routeIs('dashboard.chat.*');
        $this->getUpdateChats();
    }
    
    public function render()
    {
        return view('livewire.layouts.navigations.chat', [
            'unreadChats' => $this->unreadChats
        ]);
    }
}
