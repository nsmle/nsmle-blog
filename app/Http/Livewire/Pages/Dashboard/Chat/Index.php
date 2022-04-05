<?php

namespace App\Http\Livewire\Pages\Dashboard\Chat;

use Livewire\Component;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Auth;

class Index extends Component
{
    protected $chatRooms;
    
    public $listeners = [
        'echo:user-event,.user-message' => 'refreshData',
        'echo:user-event,.user-online' => 'refreshData',
    ];
    
    public function refreshData($data)
    {
        if ($data['data']['user']['username'] === Auth::user()->username) {
            $this->updateDataChatRoom();
        }
    }
    
    public function redirectToChatView($usernameUser)
    {
        return redirect()->to('/chat/'.$usernameUser);
    }
    
    public function updateDataChatRoom()
    {
        $this->chatRooms = Auth::user()->chatRooms();
    }
    
    public function mount()
    {
        $this->updateDataChatRoom();
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.chat.index', [
            'chatRooms' => $this->chatRooms
        ]);
    }
}
