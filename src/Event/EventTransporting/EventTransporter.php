<?php

namespace N3ttech\Messaging\Event\EventTransporting;

use N3ttech\Messaging\Message\Domain\Message;
use N3ttech\Messaging\Message\Transporting;

final class EventTransporter implements Transporting\Transporter
{
    /** @var Transporting\Driver $transportProvider */
    private $transportProvider;

    /**
     * @param Transporting\Driver $transportProvider
     */
    public function __construct(Transporting\Driver $transportProvider)
    {
        $this->transportProvider = $transportProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function publish(Message $message): void
    {
        $this->transportProvider->publish($message);
    }

    /**
     * {@inheritdoc}
     */
    public function consume(string $key): void
    {
        $this->transportProvider->consume($key);
    }
}
