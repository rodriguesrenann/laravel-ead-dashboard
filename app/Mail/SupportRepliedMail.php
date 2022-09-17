<?php

namespace App\Mail;

use App\Models\SupportReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportRepliedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supportReply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SupportReply $supportReply)
    {
        $this->supportReply = $supportReply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Duvida respondida')->markdown('mail.support-replied-mail');
    }
}
