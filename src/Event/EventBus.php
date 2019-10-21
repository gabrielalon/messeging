<?php

namespace N3ttech\Messaging\Event;

use N3ttech\Messaging\Event\Event\Event;
use N3ttech\Messaging\Message\Transporting\Transporter;

class EventBus implements \N3ttech\Messaging\Event\EventSourcing\EventBus
{
    /** @var Transporter */
    private $transporter;

    /**
     * {@inheritdoc}
     */
    public function __construct(Transporter $transporter)
    {
        $this->transporter = $transporter;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(Event $event): void
    {
        $this->transporter->publish($event);
    }
}
