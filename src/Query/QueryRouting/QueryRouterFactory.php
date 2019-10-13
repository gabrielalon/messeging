<?php

namespace N3tt3ch\Messaging\Query\QueryRouting;

use N3tt3ch\Messaging\Query\QueryHandling\QueryHandlerProvider;
use N3tt3ch\Messaging\Query\NamingStrategy\QueryHandlerSuffixNamingStrategy;
use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;

class QueryRouterFactory
{
	/** @var QueryHandlerProvider */
	private $handlerProvider;
	
	/**
	 * @param QueryHandlerProvider $handlerProvider
	 */
	public function __construct(QueryHandlerProvider $handlerProvider)
	{
		$this->handlerProvider = $handlerProvider;
	}
	
	/**
	 * @return QueryRouter
	 */
	public function createDefault(): QueryRouter
	{
		return $this->create(new QueryHandlerSuffixNamingStrategy());
	}
	
	/**
	 * @param NamingStrategy $namingStrategy
	 * @return QueryRouter
	 */
	public function create(NamingStrategy $namingStrategy): QueryRouter
	{
		return new QueryRouter($this->handlerProvider, $namingStrategy);
	}
}
