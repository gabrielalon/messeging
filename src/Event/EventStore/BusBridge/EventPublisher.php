<?php

namespace N3tt3ch\Messaging\Event\EventStore\BusBridge;

use N3tt3ch\Messaging\Event\Event\Event;
use N3tt3ch\Messaging\Event\EventSourcing\EventBus;
use N3tt3ch\Messaging\Event\EventStore\EventStorage;

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
