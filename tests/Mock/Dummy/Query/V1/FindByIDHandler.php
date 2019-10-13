<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Query\V1;

use N3tt3ch\Messaging\Message\Domain\Message;
use N3tt3ch\Messaging\Query\QueryHandling\QueryHandler;

class FindByIDHandler implements QueryHandler
{
	/** @var DummyQuery */
	private $repository;
	
	/**
	 * @param Message|FindByID $query
	 */
	public function run(Message $query): void
	{
		$this->repository->findByID($query);
	}
}