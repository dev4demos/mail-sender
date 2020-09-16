<?php

declare (strict_types = 1);

namespace Mail\Sender\Classes;

use Illuminate\Container\Container;
use Mail\Sender\Contracts\MessageContract;

class BaseMessage implements MessageContract
{
    /**
     * The message content or body.
     *
     * @var string
     */
    protected $content;

    /**
     * The person the message is from.
     *
     * @var array
     */
    protected $from = ['johndoe@gmail.com' => 'John Doe'];

    /**
     * The "to" recipients of the message.
     *
     * @var array
     */
    protected $to = [
        'janedoe@gmail.com' => 'Jane Doe',
        'tomcruise@gmail.com' => 'Tom Cruise'
    ];

    /**
     * The message attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Create a new message instance.
     */
    public static function create(): MessageContract
    {
        if ($content = current(func_get_args())) {
            return new static($content);
        }

        return new static();
    }

    /**
     * {@inheritdoc }
     */
    public function getUID(): string
    {
        return sha1($this->getSender() . $this->getContent());
    }

    /**
     * {@inheritdoc }
     */
    public function getSender(): string
    {
        return $this->getFrom();
    }

    /**
     * {@inheritdoc }
     *
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->getTo();
    }

    /**
     * {@inheritdoc }
     */
    public function getContent(): string
    {
        return (string) $this->content;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     *
     * @return self
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = array_filter($attributes, 'is_scalar');

        return $this;
    }

    /**
     * @return string|array
     */
    public function getFrom($stringify = true)
    {
        return $stringify ? $this->stringifyAddress($this->from) : $this->from;
    }

    /**
     * @param  string       $email
     * @param  string|null  $name
     *
     * @return self
     */
    public function setFrom(string $email): self
    {
        $address = call_user_func_array([$this, 'extractAddress'], func_get_args());

        !$address ?: $this->from = $address;

        return $this;
    }

    /**
     * @return string|array
     */
    public function getTo($stringify = true)
    {
        return $stringify ? $this->stringifyAddress($this->to) : $this->to;
    }

    /**
     * @param  string  $email
     *
     * @return self
     */
    public function setTo($email): self
    {
        $to = call_user_func_array([$this, 'extractAddresses'], func_get_args());

        !$to ?: $this->to = $to;

        return $this;
    }

    /**
     * Get the available container instance.
     *
     * @return Container
     */
    public function getIoc(): Container
    {
        return Container::getInstance();
    }

    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     *
     * @return mixed
     */
    public function ioc($abstract)
    {
        return is_null($abstract) ? Container::getInstance() : call_user_func_array(
            [Container::getInstance(), 'make'], func_get_args()
        );
    }

    /**
     * Build the from for the message.
     *
     * @return string
     */
    public static function stringifyAddress(array $values): string
    {
        $value = '';

        foreach ($values as $email => $name) {
            # Your Name <sitename@hostname.com>
            !$value ?: $value .= ',';

            $value .= $name . ' <' . $email . '>';
        }

        return $value;
    }

    /**
     * @param  string       $email
     * @param  string|null  $name
     *
     * @return array
     */
    public static function extractAddress(string $email, string $name = null): array
    {
        $tmp = $email;

        if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
            $email = $name;
            $name = $tmp;
        }

        $name ?: $name = current(explode('@', $email));

        return [$email => $name];
    }

    /**
     * @param  mixed   $mixed
     * @return array
     */
    public static function extractAddresses($mixed)
    {
        $addresses = [];

        !is_scalar($mixed) ?: $mixed = array_filter(func_get_args(), 'is_string');

        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $address = [];

                if (is_numeric($key) && is_string($value)) {
                    $address = static::extractAddress($value);
                } elseif (is_string($key) && is_string($value)) {
                    $address = static::extractAddress($key, $value);
                } elseif (is_string($key)) {
                    $address = static::extractAddress($key);
                }

                $addresses = array_merge($addresses, $address);
            }
        }

        return $addresses;
    }
}
