<?php

namespace N3tt3ch\Messaging\Snapshot\Persist;

use N3tt3ch\Messaging\Aggregate\AggregateId;
use N3tt3ch\Messaging\Aggregate\AggregateType;
use N3tt3ch\Messaging\Snapshot\Snapshot;

interface SnapshotRepository
{
	/**
	 * @param Snapshot\Snapshot $snapshot
	 */
    public function save(Snapshot\Snapshot $snapshot): void;
	
	/**
	 * @param AggregateType $aggregateType
	 * @param AggregateId $aggregateId
	 * @return Snapshot\Snapshot
	 */
    public function get(AggregateType $aggregateType, AggregateId $aggregateId): Snapshot\Snapshot;
}
