<?php

declare (strict_types = 1);

namespace Mail\Sender\Mailables;

use Illuminate\Support\Facades\Config;
use Mail\Sender\Classes\MailMessage;
use Mail\Sender\Contracts\StoredMessageContract;

class MessageMailable extends AbstractMailable
{
    /**
     * Create a new message instance.
     *
     * @param  StoredMessageContract|string  $request
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->setMessage(
            $message instanceof StoredMessageContract ? $message : new MailMessage($message)
        );

        $this->to(
            Config::get('sender.recipient.address'), Config::get('sender.recipient.name')
        );
    }

    /**
     * @param StoredMessageContract $message
     *
     * @return self
     */
    public function setMessage(StoredMessageContract $message): self
    {
        $this->message = $message;

        return $this;
    }
}
