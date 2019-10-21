<?php

namespace N3ttech\Messaging\Query\QueryTransporting;

use N3ttech\Messaging\Message\Domain\Message;
use N3ttech\Messaging\Message\Transporting;

final class QueryTransporter implements Transporting\Transporter
{
    /** @var Transporting\Driver $transportProvider */
    private $transportProvider;

    /**
     * {@inheritdoc}
     */
    public function __construct(Transporting\Driver $transportProvider)
    {
        $this->transportProvider = $transportProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function publish(Message $query): void
    {
        $this->transportProvider->publish($query);
    }

    /**
     * {@inheritdoc}
     */
    public function consume(string $key): void
    {
        $this->transportProvider->consume($key);
    }
}
