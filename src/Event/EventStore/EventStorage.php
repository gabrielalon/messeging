<?php

namespace N3tt3ch\Messaging\Event\EventStore;

use N3tt3ch\Messaging\Aggregate\AggregateId;
use N3tt3ch\Messaging\Aggregate\EventBridge\AggregateChanged;
use N3tt3ch\Messaging\Event\Event\Event;
use N3tt3ch\Messaging\Event\EventStore\BusBridge\EventPublisher;
use N3tt3ch\Messaging\Event\Persist\EventStreamRepository;

class EventStorage
{
    /** @var EventStreamRepository */
    private $streamRepository;

    /** @var EventPublisher */
    private $eventPublisher;

    /** @var Event */
    private $tmpLastReleasedEvent;
	
	/**
	 * @param EventStreamRepository $streamRepository
	 */
    public function __construct(EventStreamRepository $streamRepository)
    {
        $this->streamRepository = $streamRepository;
    }
	
	/**
	 * @param EventPublisher $eventPublisher
	 */
    public function setEventPublisher(EventPublisher $eventPublisher): void
    {
        $this->eventPublisher = $eventPublisher;
    }
	
	/**
	 * @param Event $event
	 * @return EventStorage
	 */
    public function release(Event $event): EventStorage
    {
        $this->eventPublisher->release($event);

        $this->tmpLastReleasedEvent = $event;

        return $this;
    }

    public function record(): void
    {
        if (null !== $this->tmpLastReleasedEvent) {
            $this->streamRepository->save($this->tmpLastReleasedEvent);
        }
    }
	
	/**
	 * @param AggregateId $aggregateId
	 * @param int $lastVersion
	 * @return \ArrayIterator
	 */
    public function load(AggregateId $aggregateId, int $lastVersion)
    {
        $iterator = new \ArrayIterator();

        foreach ($this->streamRepository->load($aggregateId, $lastVersion)->getArrayCopy() as $eventStream) {
        	/** @var AggregateChanged $event */
            $event = $eventStream->getEventName();
            $iterator->append($event::fromEventStream($eventStream));
        }

        return $iterator;
    }
}
