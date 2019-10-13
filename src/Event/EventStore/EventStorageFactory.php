<?php

namespace N3tt3ch\Messaging\Event\EventStore;

use N3tt3ch\Messaging\Event\EventBus;
use N3tt3ch\Messaging\Event\EventStore\BusBridge\EventPublisher;
use N3tt3ch\Messaging\Event\Persist\EventStreamRepository;

class EventStorageFactory
{
	/** @var EventStreamRepository */
	private $streamRepository;
	
	/**
	 * @param EventStreamRepository $streamRepository
	 */
	public function __construct(EventStreamRepository $streamRepository)
	{
		$this->streamRepository = $streamRepository;
	}
	
	/**
	 * @param EventBus $bus
	 * @return EventStorage
	 */
	public function create(EventBus $bus): EventStorage
	{
		$eventStorage = new EventStorage($this->streamRepository);
		
		$eventPublisher = new EventPublisher($bus);
		$eventPublisher->attachToEventStorage($eventStorage);
		
		return $eventStorage;
	}
}