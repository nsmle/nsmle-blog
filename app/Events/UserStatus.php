<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class UserStatus implements ShouldBroadcast
{
    protected $userUsername;
    
    protected $userStatus;
    
    protected $data;
    
    protected $listen;
    
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $userUsername, string $userStatus, array $data, string $listen)
    {
        $this->userUsername = $userUsername;
        $this->userStatus = $userStatus;
        $this->data = $data;
        $this->listen = $listen;
    }
    
    public function broadcastWith()
    {
        return [
            'user' => $this->userUsername,
            'userStatus' => $this->userStatus,
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
        return new Channel('user-status');
    }
}
