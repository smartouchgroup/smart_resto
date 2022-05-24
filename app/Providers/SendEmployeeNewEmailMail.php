<?php

namespace App\Providers;

use App\Providers\EmailChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmployeeNewEmailMail
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
     * @param  \App\Providers\EmailChanged  $event
     * @return void
     */
    public function handle(EmailChanged $event)
    {
        //
    }
}
