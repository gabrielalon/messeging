<?php

namespace N3tt3ch\Messaging\Command\CommandHandling;

use N3tt3ch\Messaging\Message\Messaging\MessageHandler;
use N3tt3ch\Messaging\Message\Messaging\MessageHandlerProvider;
use Psr\Container\ContainerInterface;

final class CommandHandlerProvider implements MessageHandlerProvider
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
	 * @param string $messageHandlerName
	 * @return MessageHandler
	 */
	public function retrieve(string $messageHandlerName): MessageHandler
	{
		return $this->container->get($messageHandlerName);
	}
}