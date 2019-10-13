<?php

namespace N3tt3ch\Messaging\Command\CommandRouting;

use N3tt3ch\Messaging\Command\CommandHandling\CommandHandlerProvider;
use N3tt3ch\Messaging\Message\Messaging\MessageHandler;
use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;
use N3tt3ch\Messaging\Message\Routing\MessageRouter;

final class CommandRouter implements MessageRouter
{
	/** @var NamingStrategy */
	private $namingStrategy;
	
	/** @var CommandHandlerProvider */
	private $handlerProvider;
	
	/**
	 * @param CommandHandlerProvider $handlerProvider
	 * @param NamingStrategy $namingStrategy
	 */
	public function __construct(
		CommandHandlerProvider $handlerProvider,
		NamingStrategy $namingStrategy
	) {
		$this->namingStrategy = $namingStrategy;
		$this->handlerProvider = $handlerProvider;
	}
	
	/**
	 * @param string $messageName
	 * @return MessageHandler
	 */
	public function map(string $messageName): MessageHandler
	{
		$handlerClass = $this->namingStrategy->retrieveName($messageName);
		
		/** @var MessageHandler $handler */
		$handler = $this->handlerProvider->retrieve($handlerClass);
		
		return $handler;
	}
}
