<?php

namespace App\Listeners;

use App\Events\SupportReplied;
use App\Mail\SupportRepliedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailAfterSupportReplied
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
     * @param  \App\Events\SupportReplied  $event
     * @return void
     */
    public function handle(SupportReplied $event)
    {
        $supportReply = $event->getSupport();
        $support = $supportReply->support;
        $user = $support->user;

        Mail::to($user->email)->send(new SupportRepliedMail($supportReply));
    }
}
