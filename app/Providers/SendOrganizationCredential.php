<?php

namespace App\Providers;

use App\Mail\OrganizationCreatedMail;
use App\Providers\OrganizationAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrganizationCredential
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
     * @param  \App\Providers\OrganizationAdded  $event
     * @return void
     */
    public function handle(OrganizationAdded $event)
    {
        Mail::to($event->userEmail)->send(new OrganizationCreatedMail($event->mailData));
    }
}
