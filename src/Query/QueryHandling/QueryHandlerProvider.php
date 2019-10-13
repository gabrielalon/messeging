<?php

namespace N3tt3ch\Messaging\Query\QueryHandling;

use N3tt3ch\Messaging\Message\Messaging\MessageHandler;
use N3tt3ch\Messaging\Message\Messaging\MessageHandlerProvider;
use Psr\Container\ContainerInterface;

final class QueryHandlerProvider implements MessageHandlerProvider
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
	 * @param string $queryHandlerName
	 * @return MessageHandler
	 */
	public function retrieve(string $queryHandlerName): MessageHandler
	{
		return $this->container->get($queryHandlerName);
	}
}