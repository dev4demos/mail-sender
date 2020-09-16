<?php

declare (strict_types = 1);

namespace Mail\Sender\Classes;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Mail\Sender\Contracts\StoredMessageContract;
use StdClass;

class MailMessage extends BaseMessage implements StoredMessageContract
{
    /**
     * The column for storing message unique identifier.
     *
     * @var string
     */
    protected $UIDColumn = 'uid';

    /**
     * The table for storing messages.
     *
     * @var string
     */
    protected $tableName = 'messages';

    /**
     * The stored message attributes.
     *
     * @var StdClass|null
     */
    protected $stored;

    /**
     * @param  string  $content
     * @return void
     */
    public function __construct($content)
    {
        $this->setContent($content);
    }

    /**
     * {@inheritdoc }
     */
    public function store(): bool
    {
        try {
            $this->getQuery()->insert(array_merge([
                $this->getUIDColumn() => $this->getUID(),
                'content' => $this->getContent(),
                'sender' => $this->getSender()
            ], $this->getAttributes()));

            return true;

        } catch (\Exception $e) {
            // report database errors
        }

        return false;
    }

    /**
     * {@inheritdoc }
     */
    public function exists(): bool
    {
        return $this->getFetch() ? true : false;
    }

    /**
     * {@inheritdoc }
     */
    public function wasSent(): bool
    {
        if ($item = $this->getFetch()) {
            return !empty($item->sent);
        }

        return false;
    }

    public function notSent(): bool
    {
        return !$this->wasSent();
    }

    /**
     * {@inheritdoc }
     */
    public function getUIDColumn(): string
    {
        return $this->UIDColumn;
    }

    /**
     * @param string $UIDColumn
     *
     * @return self
     */
    public function setUIDColumn(string $UIDColumn): self
    {
        $this->UIDColumn = $UIDColumn;

        return $this;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     *
     * @return self
     */
    public function setTableName(string $tableName): self
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->ioc('db')->connection();
    }

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->getConnection()->table($this->getTableName());
    }

    /**
     * Get the stored message attributes or fetch attributes from storage.
     *
     * @return StdClass
     */
    public function getFetch($refetch = false)
    {
        if ($refetch || is_null($this->stored)) {
            $this->stored = $this->getQuery()->where($this->getUIDColumn(), $this->getUID())->first();
        }

        return $this->stored;
    }

    /**
     * @return StdClass|null
     */
    public function getStored($toArray = true)
    {
        $data = $this->getFetch(true);

        if ($toArray) {
            return (array) $data;
        }

        return $data;
    }
}
