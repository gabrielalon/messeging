<?php

namespace N3ttech\Messaging\Event\Persist;

use N3ttech\Messaging\Aggregate\AggregateId;
use N3ttech\Messaging\Event\Event\Event;
use N3ttech\Messaging\Event\EventStore\Stream\EventStreamCollection;

interface EventStreamRepository
{
    /**
     * @param Event $event
     */
    public function save(Event $event): void;

    /**
     * @param AggregateId $aggregateId
     * @param int         $lastVersion
     *
     * @return EventStreamCollection
     */
    public function load(AggregateId $aggregateId, int $lastVersion): EventStreamCollection;
}
