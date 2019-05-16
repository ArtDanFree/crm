<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LeadApprovalNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chin;

    public $notification;

    public function __construct($chin)
    {
        $this->chin = $chin;
        $this->notification = $this->countNotification($chin);
    }


    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->chin->id);
    }

    public function countNotification($chin)
    {
        return $chin->leadNotification->count();
    }
}
