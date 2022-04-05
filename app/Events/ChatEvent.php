<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $listen;
    
    public $roomId;
    
    public $info;
    
    public $data;
    

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($roomId, $listen, $info, $data)
    {
        $this->roomId = $roomId;
        $this->listen = $listen;
        $this->info = $info;
        $this->data = $data;
    }
    
    public function broadcastWith()
    {
        return [
            'info' => $this->info,
            'data' => $this->data
        ];
    }
    
    public function broadcastAs()
    {
        return $this->listen;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("chat-event.{$this->roomId}");
    }
}
