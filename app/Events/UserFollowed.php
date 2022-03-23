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

class UserFollowed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    protected $fromUser;
    
    protected $toUser;
    
    protected $status;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fromUser, $toUser, $status = null)
    {
        $this->fromUser = $fromUser;
        $this->toUser = $toUser;
        $this->status = $status;
    }
    
    public function broadcastWith()
    {
        return [
            'fromUser' => $this->fromUser,
            'toUser' => $this->toUser,
            'status' => $this->status
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastAs()
     {
         return 'follow';
     }
    public function broadcastOn()
    {
        return new PrivateChannel('user-followed');
    }
}
