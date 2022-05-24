<?php

namespace App\Providers;

use App\Models\Organization;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrganizationAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $mailData;
    public $userEmail;
    public function __construct(Organization $organization, String $password)
    {
        $this->mailData['firstname'] = $organization->user->firstname;
        $this->mailData['email'] = $organization->user->email;
        $this->mailData['phone'] = $organization->user->phone;
        $this->mailData['password'] = $password;
        $this->userEmail = $organization->user->email;
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
