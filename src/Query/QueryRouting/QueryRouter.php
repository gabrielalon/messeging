<?php

namespace N3tt3ch\Messaging\Query\QueryRouting;

use N3tt3ch\Messaging\Query\QueryHandling\QueryHandlerProvider;
use N3tt3ch\Messaging\Message\Messaging\MessageHandler;
use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;
use N3tt3ch\Messaging\Message\Routing\MessageRouter;

final class QueryRouter implements MessageRouter
{
	/** @var NamingStrategy */
	private $namingStrategy;
	
	/** @var QueryHandlerProvider */
	private $handlerProvider;
	
	/**
	 * @param QueryHandlerProvider $handlerProvider
	 * @param NamingStrategy $namingStrategy
	 */
	public function __construct(
		QueryHandlerProvider $handlerProvider,
		NamingStrategy $namingStrategy
	) {
		$this->namingStrategy = $namingStrategy;
		$this->handlerProvider = $handlerProvider;
	}
	
	/**
	 * @param string $queryName
	 * @return MessageHandler
	 */
	public function map(string $queryName): MessageHandler
	{
		$handlerClass = $this->namingStrategy->retrieveName($queryName);
		
		/** @var MessageHandler $handler */
		$handler = $this->handlerProvider->retrieve($handlerClass);
		
		return $handler;
	}
}
