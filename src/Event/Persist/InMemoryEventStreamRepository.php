<?php

namespace N3ttech\Messaging\Event\Persist;

use N3ttech\Messaging\Aggregate\AggregateId;
use N3ttech\Messaging\Aggregate\EventBridge\AggregateChanged;
use N3ttech\Messaging\Event\Event\Event;
use N3ttech\Messaging\Event\EventStore\Stream\EventStream;
use N3ttech\Messaging\Event\EventStore\Stream\EventStreamCollection;

class InMemoryEventStreamRepository implements EventStreamRepository
{
    /** @var Event[][][] */
    private $events = [];

    /**
     * {@inheritdoc}
     */
    public function save(Event $event): void
    {
        $this->events[$event->aggregateId()][$event->version()][] = $event;
    }

    /**
     * {@inheritdoc}
     */
    public function load(AggregateId $aggregateId, int $lastVersion): EventStreamCollection
    {
        $collection = new EventStreamCollection();

        if (false === isset($this->events[$aggregateId->toString()][$lastVersion])) {
            return $collection;
        }

        /** @var AggregateChanged $event */
        foreach ($this->events[$aggregateId->toString()][$lastVersion] as $event) {
            $collection->add(new EventStream(
                $event->aggregateId(),
                $event->version(),
                $event->messageName(),
                $event->payload(),
                $event->metadata()
            ));
        }

        return $collection;
    }
}
