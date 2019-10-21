<?php

namespace N3ttech\Messaging\Event\EventStore\BusBridge;

use N3ttech\Messaging\Event\Event\Event;
use N3ttech\Messaging\Event\EventSourcing\EventBus;
use N3ttech\Messaging\Event\EventStore\EventStorage;

class EventPublisher
{
    /** @var EventBus */
    private $eventBus;

    /**
     * @param EventBus $eventBus
     */
    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    /**
     * @param EventStorage $eventStorage
     */
    public function attachToEventStorage(EventStorage $eventStorage): void
    {
        $eventStorage->setEventPublisher($this);
    }

    /**
     * @param Event $event
     */
    public function release(Event $event): void
    {
        $this->eventBus->dispatch($event);
    }
}
