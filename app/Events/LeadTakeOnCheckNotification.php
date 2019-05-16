<?php

namespace App\Events;

use App\Models\Lead;
use App\Models\LeadNotification;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LeadTakeOnCheckNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chinId;

    public function __construct(Lead $lead)
    {
        $this->chinId = $lead->chin_id;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('user.' . $this->chinId),
            new PrivateChannel('admins'),
            new PrivateChannel('underwriters'),
        ];
    }
}