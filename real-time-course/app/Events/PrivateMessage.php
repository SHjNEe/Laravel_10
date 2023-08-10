<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivateMessage implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $message;
    // public $userId;

    public function __construct($message)
    {
        $this->message = $message;
        // $this->userId = $userId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('private-chat');
    }
}
