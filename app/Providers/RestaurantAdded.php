<?php

namespace App\Providers;

use App\Models\Restaurant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RestaurantAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $mailData;
    public $userEmail;
    public function __construct(Restaurant $restaurant, String $password)
    {
        $this->mailData['firstname'] = $restaurant->user->firstname;
        $this->mailData['email'] = $restaurant->user->email;
        $this->mailData['phone'] = $restaurant->user->phone;
        $this->mailData['password'] = $password;
        $this->userEmail = $restaurant->user->email;
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
