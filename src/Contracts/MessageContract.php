<?php

declare (strict_types = 1);

namespace Mail\Sender\Contracts;

interface MessageContract
{
    /**
     * The message unique identifier
     *
     * @return string
     */
    public function getUID(): string;

    /**
     * The sender of the message
     *
     * @return string
     */
    public function getSender(): string;

    /**
     * The recipients of the message.
     *
     * @return string
     */
    public function getRecipient(): string;

    /**
     * The content of the message
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * The message attributes
     *
     * @return array
     */
    public function getAttributes(): array;
}
