<?php

namespace App\Providers;

use App\Mail\RestaurantCreatedMail;
use App\Providers\RestaurantAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRestaurantCredential
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
     * @param  \App\Providers\RestaurantAdded  $event
     * @return void
     */
    public function handle(RestaurantAdded $event)
    {
            Mail::to($event->userEmail)->send(new RestaurantCreatedMail($event->mailData));
    }
}
