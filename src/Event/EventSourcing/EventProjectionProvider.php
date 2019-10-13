<?php

namespace N3tt3ch\Messaging\Event\EventSourcing;

use N3tt3ch\Messaging\Message\EventSourcing\EventProjector;
use Psr\Container\ContainerInterface;

final class EventProjectionProvider
{
	/** @var ContainerInterface */
	protected $container;
	
	/**
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
	
	/**
	 * @param string $projectionName
	 * @return EventProjector
	 */
	public function retrieve(string $projectionName): EventProjector
	{
		return $this->container->get($projectionName);
	}
}