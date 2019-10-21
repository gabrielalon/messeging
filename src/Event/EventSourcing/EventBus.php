<?php

namespace N3ttech\Messaging\Event\EventSourcing;

use N3ttech\Messaging\Event\Event\Event;
use N3ttech\Messaging\Message\Messaging\MessageBus;

interface EventBus extends MessageBus
{
    /**
     * @param Event $event
     */
    public function dispatch(Event $event): void;
}
