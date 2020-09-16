<?php

declare (strict_types = 1);

namespace Mail\Sender\Mailables;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mail\Sender\Contracts\MessageContract;

abstract class AbstractMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var MessageContract
     */
    protected $message;

    /**
     * @return MessageContract
     */
    public function getMessage(): MessageContract
    {
        return $this->message;
    }

    /**
     * @return MessageContract
     */
    public function message(): MessageContract
    {
        return $this->getMessage();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = ['body' => $this->getMessage()->getContent()];

        return $this->view('sender::email', $data)->text('sender::email_plain', $data);
    }

    /**
     * {@inheritdoc }
     */
    public function from($address, $name = null)
    {
        parent::from($address, $name);

        $this->getMessage()->setFrom($address, $name);

        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function to($address, $name = null)
    {
        parent::to($address, $name);

        $this->getMessage()->setTo($address, $name);

        return $this;
    }
}
