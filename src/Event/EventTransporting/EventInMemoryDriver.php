<?php

namespace N3tt3ch\Messaging\Event\EventTransporting;

use N3tt3ch\Messaging\Event\Event\Event;
use N3tt3ch\Messaging\Event\EventRouting\EventRouter;
use N3tt3ch\Messaging\Event\EventSourcing\EventProjectionProvider;
use N3tt3ch\Messaging\Message\Domain\Message;
use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;
use N3tt3ch\Messaging\Message\Transporting\Driver;

final class EventInMemoryDriver implements Driver
{
	/** @var EventRouter */
	private $router;
	
	/** @var NamingStrategy */
	private $namingStrategy;
	
	/** @var EventProjectionProvider */
	private $projectionProvider;
	
	/** @var Event[] */
	private $events = [];
	
	/**
	 * @param EventRouter $router
	 * @param NamingStrategy $namingStrategy
	 * @param EventProjectionProvider $projectionProvider
	 */
	public function __construct(
		EventRouter $router,
		NamingStrategy $namingStrategy,
		EventProjectionProvider $projectionProvider
	) {
		$this->router = $router;
		$this->namingStrategy = $namingStrategy;
		$this->projectionProvider = $projectionProvider;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function publish(Message $event): bool
	{
		/** @var Event $event */
		$this->events[$event->eventName()] = $event;
		
		return $this->consume($event->eventName());
		
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function consume(string $eventName): bool
	{
		try
		{
			$event = $this->retrieve($eventName);
		} catch (\InvalidArgumentException $e) {
			return false;
		}
		
		$this->release($event->eventName());
		
		$methodName = $this->namingStrategy->retrieveName($event->eventName());
		foreach ($this->router->map($event->eventName()) as $projectorName) {
			$projector = $this->projectionProvider->retrieve($projectorName);
			
			call_user_func([$projector, $methodName], $event);
		}
		
		return true;
	}
	
	/**
	 * @param string $key
	 * @return Event
	 * @throws \InvalidArgumentException
	 */
	private function retrieve(string $key): Event
	{
		if (false === isset($this->events[$key])) {
			throw new \InvalidArgumentException(\sprintf('Event %s does not exists in memory!',
				$key
			));
		}
		
		return $this->events[$key];
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function release(string $key): void
	{
		unset($this->events[$key]);
	}
}