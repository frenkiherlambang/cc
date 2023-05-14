<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateBalance implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $userBalance = 0;

    /**
     * Create a new event instance.
     */
    public function __construct($userBalance)
    {
        $this->userBalance = $userBalance;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('update-balance');
    }

    public function broadcastAs()
    {
        return 'update-balance';
    }

    public function broadcastWith()
    {
        return [
            'data' =>
                [
                    'userBalance' => $this->userBalance
                ]
        ];
    }

}
