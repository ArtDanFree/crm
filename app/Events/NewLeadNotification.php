<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewLeadNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;


    public function __construct($chin_id)
    {
        $this->id = $chin_id;
    }


    public function broadcastOn()
    {
        return [
            new PrivateChannel('user.' . $this->id),
            new PrivateChannel('admins'),
            new PrivateChannel('underwriters'),
        ];
    }
}
