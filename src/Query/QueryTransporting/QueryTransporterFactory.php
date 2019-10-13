<?php

namespace N3tt3ch\Messaging\Query\QueryTransporting;

use N3tt3ch\Messaging\Query\QueryRouting\QueryRouter;
use N3tt3ch\Messaging\Message\Transporting\Driver;

class QueryTransporterFactory
{
	/** @var QueryRouter */
	private $router;
	
	/**
	 * @param QueryRouter $router
	 */
	public function __construct(QueryRouter $router)
	{
		$this->router = $router;
	}
	
	/**
	 * @return QueryTransporter
	 */
	public function createDefault(): QueryTransporter
	{
		return $this->create(new QueryInMemoryDriver($this->router));
	}
	
	/**
	 * @param Driver $transportProvider
	 * @return QueryTransporter
	 */
	public function create(Driver $transportProvider): QueryTransporter
	{
		return new QueryTransporter($transportProvider);
	}
}