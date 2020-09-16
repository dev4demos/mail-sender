<?php

declare (strict_types = 1);

namespace Mail\Sender\Contracts;

interface StoredMessageContract extends MessageContract
{
    /**
     * Store the message in the storage
     *
     * @return bool
     */
    public function store(): bool;

    /**
     * If the message already exists in database
     *
     * @return bool
     */
    public function exists(): bool;

    /**
     * If the message has already been sent
     *
     * @return bool
     */
    public function wasSent(): bool;

    /**
     * The column for storing message unique identifier.
     *
     * @return string
     */
    public function getUIDColumn(): string;
}
