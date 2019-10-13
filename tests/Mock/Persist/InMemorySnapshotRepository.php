<?php

namespace N3tt3ch\Messaging\Test\Mock\Persist;

use N3tt3ch\Messaging\Aggregate\AggregateId;
use N3tt3ch\Messaging\Aggregate\AggregateType;
use N3tt3ch\Messaging\Aggregate\EventBridge\AggregateRootDecorator;
use N3tt3ch\Messaging\Snapshot\Persist\SnapshotRepository;
use N3tt3ch\Messaging\Snapshot\Snapshot;

class InMemorySnapshotRepository implements SnapshotRepository
{
	/** @var Snapshot\Snapshot[][] */
	private $snapshots = [];
	
	/**
	 * @param Snapshot\Snapshot $snapshot
	 */
	public function save(Snapshot\Snapshot $snapshot): void
	{
		$aggregateType = AggregateType::fromAggregateRoot($snapshot->getAggregateRoot())->getAggregateType();
		$aggregateId = AggregateRootDecorator::newInstance()->extractAggregateId($snapshot->getAggregateRoot());
		$this->snapshots[$aggregateType][$aggregateId->toString()] = $snapshot;
	}
	
	/**
	 * @param AggregateType $aggregateType
	 * @param AggregateId $aggregateId
	 * @return Snapshot\Snapshot
	 */
	public function get(AggregateType $aggregateType, AggregateId $aggregateId): Snapshot\Snapshot
	{
		if (false === isset($this->snapshots[$aggregateType->getAggregateType()][$aggregateId->toString()])) {
			throw new \RuntimeException('Snapshot not found for aggregate: ' . $aggregateId->toString());
		}
		
		return $this->snapshots[$aggregateType->getAggregateType()][$aggregateId->toString()];
	}
}