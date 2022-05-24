<?php

namespace App\Providers;

use App\Models\Employee;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeeAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */


     public $mailData;
     public $userEmail;


    public function __construct(Employee $employee, String $password)
    {
        $this->mailData['firstname'] = $employee->user->firstname;
        $this->mailData['email'] = $employee->user->email;
        $this->mailData['phone'] = $employee->user->phone;
        $this->mailData['password'] = $password;
        $this->mailData['organization'] = $employee->organization->user->firstname;
        $this->mailData['identityCode'] = $employee->identityCode;
        $this->userEmail = $employee->user->email;
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
