<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Persist;

use N3tt3ch\Messaging\Aggregate\Persist\AggregateRepository;
use N3tt3ch\Messaging\Test\Mock\Dummy\Dummy;

class DummyRepository extends AggregateRepository
{
	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return Dummy::class;
	}
	
	/**
	 * @param Dummy $dummy
	 */
	public function save(Dummy $dummy): void
	{
		$this->saveAggregateRoot($dummy);
	}
	
	/**
	 * @param string $id
	 * @return Dummy
	 */
	public function find(string $id): Dummy
	{
		/** @var Dummy $dummy */
		$dummy = $this->findAggregateRoot(Dummy\ID::fromId($id));
		
		return $dummy;
	}
}