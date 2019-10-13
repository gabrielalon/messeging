<?php

namespace N3tt3ch\Messaging\Event\EventRouting;

final class EventRouter implements \N3tt3ch\Messaging\Message\Routing\EventRouter
{
	/** @var string[] */
	private $map = [];
	
	/**
	 * @param string[] $map
	 */
	public function __construct(array $map)
	{
		$this->map = $map;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function map(string $eventName): array
	{
		if (false === isset($this->map[$eventName])) {
			throw new \InvalidArgumentException(\sprintf('Given event name %s is not registered!',
				$eventName
			));
		}
		
		return $this->map[$eventName];
	}
}
