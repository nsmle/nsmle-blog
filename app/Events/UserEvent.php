<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    protected $listen;
    
    protected $userUsername;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public function __construct(string $listen, string $userUsername)
    {
        $this->listen = $listen;
        $this->userUsername = $userUsername;
    }
    
    public function broadcastWith()
    {
        return [
            'data' => [
                'user' => [
                    'username' => $this->userUsername
                ],
            ],
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
        return new Channel('user-event');
    }
}
