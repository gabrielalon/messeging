<?php

namespace N3ttech\Messaging\Snapshot\Persist;

use N3ttech\Messaging\Aggregate\AggregateType;
use N3ttech\Messaging\Snapshot\Snapshot;
use N3ttech\Valuing\Identity\AggregateId;

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
