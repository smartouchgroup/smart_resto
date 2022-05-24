<?php

namespace App\Providers;

use App\Mail\AccountCreatedMail;
use App\Providers\EmployeeAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmployeeCredential
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\EmployeeAdded  $event
     * @return void
     */
    public function handle(EmployeeAdded $event)
    {
        Mail::to($event->userEmail)->send(new AccountCreatedMail($event->mailData));
    }
}
