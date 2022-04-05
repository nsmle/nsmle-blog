<?php

namespace App\Http\Livewire\Pages\Dashboard\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Events\ChatEvent;
use App\Events\UserEvent;
use Auth;

class Show extends Component
{
    public $user;
    
    public $room;
    
    public $chats;
    
    public function getListeners()
    {
        if (!empty($this->room)) {
            return [
                'sendMessage' => 'sendMessage',
                "echo-private:chat-event.{$this->room->id},.user-online" => 'updateDataUser',
                "echo-private:chat-event.{$this->room->id},.chat-message" => 'updateDataChats',
            ];
        }
        
        return [
            'sendMessage' => 'sendMessage',
            //"echo-presence:chat-event.{$this->room->id},typing,typing" => 'presenceTyping'
        ];
        
    }
    
    public function sendMessage($messageContent)
    {
        if (empty($messageContent)) {
            return $this->updateDataChats();
        }
        
        $room = $this->room;
        if (empty($room)) {
            $room = ChatRoom::create([
                'user_id_1' => Auth::id(),
                'user_id_2' => $this->user->id
            ]);
        } else {
            $room->update([
                'updated_at' => now()
            ]);
        }
        
        $chat = ChatMessage::create([
            'user_id' => Auth::id(),
            'chat_room_id' => $room->id,
            'message' => $messageContent
        ]);
        
        broadcast(new ChatEvent(
            $room->id,
            'chat-message',
            [
                'status' => "message",
                'time' => now()
            ],
            [
                'chat' => $chat,
            ]
        ))->toOthers();
        broadcast(new UserEvent('user-message', $this->user->username))->toOthers();
        $this->dispatchBrowserEvent('chat-message');
        
        $this->updateDataChats();
    }
    
    public function updateDataUser($data)
    {
        if ($data['data']['user']['username'] == $this->user->username) {
            $this->user = User::find($this->user->id);
            if (!empty($this->room)) {
                $this->room->readAllUnreadMessage($this->user->id);
            }
        }
    }
    
    public function updateDataChats()
    {
        $this->room = $this->user->getRoom();
        
        if (!empty($this->room)) {
            $this->room->readAllUnreadMessage($this->user->id);
            $this->chats = $this->room->chats;
        }
        
        $this->userOnline();
        $this->dispatchBrowserEvent('scroll-to-bottom-message');
    }
    
    public function userOnline()
    {
        if (!empty($this->room)) {
            broadcast(new ChatEvent(
                $this->room->id,
                'user-online',
                [
                    'status' => "user-online",
                    'time' => now()
                ],
                [
                    'user' => [
                        'username' => $this->user->username
                    ],
                ]
            ))->toOthers();
        }
    }
    
    public function mount(User $user)
    {
        $this->user = $user;
        $this->updateDataChats();
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.chat.show', [
            'user' => $this->user,
            'chats' => $this->chats
        ])->layout('layouts.app');
    }
}
