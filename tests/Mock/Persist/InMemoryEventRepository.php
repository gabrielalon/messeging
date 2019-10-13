<?php

namespace N3tt3ch\Messaging\Test\Mock\Persist;

use N3tt3ch\Messaging\Aggregate\AggregateId;
use N3tt3ch\Messaging\Aggregate\EventBridge\AggregateChanged;
use N3tt3ch\Messaging\Event\Event\Event;
use N3tt3ch\Messaging\Event\EventStore\Stream;
use N3tt3ch\Messaging\Event\Persist\EventStreamRepository;

class InMemoryEventRepository implements EventStreamRepository
{
	/** @var Event[][] */
	private $events;
	
	/**
	 * @param Event $event
	 */
	public function save(Event $event): void
	{
		$this->events[$event->aggregateId()][$event->version()] = $event;
	}
	
	/**
	 * @param AggregateId $aggregateId
	 * @param int $lastVersion
	 * @return Stream\EventStreamCollection
	 */
	public function load(AggregateId $aggregateId, int $lastVersion): Stream\EventStreamCollection
	{
		$collection = new Stream\EventStreamCollection();
		
		if (false === isset($this->events[$aggregateId->toString()][$lastVersion])) {
			return $collection;
		}
		
		/** @var AggregateChanged $event */
		$event = $this->events[$aggregateId->toString()][$lastVersion];
		$collection->add(new Stream\EventStream(
			$event->aggregateId(),
			$event->version(),
			$event->messageName(),
			$event->payload(),
			$event->metadata()
		));
		
		return $collection;
	}
}