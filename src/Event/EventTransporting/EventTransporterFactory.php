<?php

namespace N3tt3ch\Messaging\Event\EventTransporting;

use N3tt3ch\Messaging\Event\EventRouting\EventRouter;
use N3tt3ch\Messaging\Event\EventSourcing\EventProjectionProvider;
use N3tt3ch\Messaging\Event\NamingStrategy\EventOnPrefixNamingStrategy;
use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;
use N3tt3ch\Messaging\Message\Transporting\Driver;

class EventTransporterFactory
{
	/** @var EventRouter */
	private $router;
	
	/** @var EventProjectionProvider */
	private $projectionProvider;
	
	/**
	 * @param EventRouter $router
	 * @param EventProjectionProvider $projectionProvider
	 */
	public function __construct(EventRouter $router, EventProjectionProvider $projectionProvider)
	{
		$this->router = $router;
		$this->projectionProvider = $projectionProvider;
	}
	
	/**
	 * @return EventTransporter
	 */
	public function createDefault(): EventTransporter
	{
		$namingStrategy = new EventOnPrefixNamingStrategy();
		$driver = new EventInMemoryDriver($this->router, $namingStrategy, $this->projectionProvider);
		
		return $this->create($driver);
	}
	
	/**
	 * @param Driver $driver
	 * @return EventTransporter
	 */
	public function create(Driver $driver): EventTransporter
	{
		return new EventTransporter($driver);
	}
}