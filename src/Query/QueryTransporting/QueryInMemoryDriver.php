<?php

namespace N3tt3ch\Messaging\Query\QueryTransporting;

use N3tt3ch\Messaging\Query\Query\Query;
use N3tt3ch\Messaging\Query\QueryRouting\QueryRouter;
use N3tt3ch\Messaging\Message\Domain\Message;
use N3tt3ch\Messaging\Message\Transporting\Driver;

final class QueryInMemoryDriver implements Driver
{
	/** @var QueryRouter */
	private $router;
	
	/** @var Query[] */
	private $queries = [];
	
	/**
	 * @param QueryRouter $router
	 */
	public function __construct(QueryRouter $router)
	{
		$this->router = $router;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function publish(Message $query): bool
	{
		/** @var Query $query */
		$this->queries[$query->queryName()] = $query;
		
		return $this->consume($query->queryName());
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function consume(string $queryName): bool
	{
		try
		{
			$query = $this->retrieve($queryName);
		} catch (\InvalidArgumentException $e) {
			return false;
		}
		
		$this->release($query->queryName());
		$this->router->map($query->queryName())->run($query);
		
		return true;
	}
	
	/**
	 * @param string $key
	 * @return Query
	 * @throws \InvalidArgumentException
	 */
	private function retrieve(string $key): Query
	{
		if (false === isset($this->queries[$key])) {
			throw new \InvalidArgumentException(\sprintf('Query %s does not exists in memory!',
				$key
			));
		}
		
		return $this->queries[$key];
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function release(string $key): void
	{
		unset($this->queries[$key]);
	}
}