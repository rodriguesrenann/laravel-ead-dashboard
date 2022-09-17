<?php

namespace App\Events;

use App\Models\SupportReply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SupportReplied
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    protected $supportReply;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SupportReply $supportReply)
    {
        $this->supportReply = $supportReply;
    }

    public function getSupport(): SupportReply
    {
        return $this->supportReply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
