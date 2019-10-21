<?php

namespace N3ttech\Messaging\Snapshot\Persist;

use N3ttech\Messaging\Aggregate\AggregateId;
use N3ttech\Messaging\Aggregate\AggregateType;
use N3ttech\Messaging\Snapshot\Snapshot;

interface SnapshotRepository
{
    /**
     * @param Snapshot\Snapshot $snapshot
     */
    public function save(Snapshot\Snapshot $snapshot): void;

    /**
     * @param AggregateType $aggregateType
     * @param AggregateId   $aggregateId
     *
     * @return Snapshot\Snapshot
     */
    public function get(AggregateType $aggregateType, AggregateId $aggregateId): Snapshot\Snapshot;
}
