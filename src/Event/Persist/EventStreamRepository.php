<?php

namespace N3tt3ch\Messaging\Event\Persist;

use N3tt3ch\Messaging\Aggregate\AggregateId;
use N3tt3ch\Messaging\Event\Event\Event;
use N3tt3ch\Messaging\Event\EventStore\Stream\EventStreamCollection;

interface EventStreamRepository
{
	/**
	 * @param Event $event
	 */
    public function save(Event $event): void;
	
	/**
	 * @param AggregateId $aggregateId
	 * @param int $lastVersion
	 * @return EventStreamCollection
	 */
    public function load(AggregateId $aggregateId, int $lastVersion): EventStreamCollection;
}
