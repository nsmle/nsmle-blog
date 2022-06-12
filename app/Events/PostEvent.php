<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    protected $listen;
    
    protected $postSlug;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public function __construct(string $listen, string $postSlug)
    {
        $this->listen = $listen;
        $this->postSlug = $postSlug;
    }
    
    public function broadcastWith()
    {
        return [
            'data' => [
                'post' => [
                    'slug' => $this->postSlug
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
        return new Channel('post-event');
    }
}
