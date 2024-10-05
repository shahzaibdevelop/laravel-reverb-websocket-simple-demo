<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
//implement shouldbroadcastnow to make it brodcastable
//Difference between shouldbroadcastnow and shouldbroadcast is shouldbroadcast add to queue and require php artisan queue:work to run but shouldbroadcastnow dont put running event task in queue and dont the queue work command running
class Example implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

     
    // public string $message = "Hello this data will be available when this event is triggered and we listen for this event in client side";
    protected User $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function broadcastWith() : array {
        return [
            'user'=>[
                'name'=>$this->user->name,
                'email'=>$this->user->email,
            ]
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat'),
        ];
    }
}
