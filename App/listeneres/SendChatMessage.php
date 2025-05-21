<?php

namespace App\Listeners;

use App\Events\MessageSent;

class SendChatMessage
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
     * @return void
     */
    public function handle(MessageSent $event)
    {
        //
    }
}
