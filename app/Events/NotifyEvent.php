<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Auth;

class NotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    protected $listen;
    
    protected $info;
    
    protected $data;
    
    protected $authorizeUserId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($authorizeUserId, $listen, $info, $data)
    {
        $this->authorizeUserId = $authorizeUserId;
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
        return new PrivateChannel("notify-event.{$this->authorizeUserId}");
    }
}
