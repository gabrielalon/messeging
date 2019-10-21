<?php

namespace N3ttech\Messaging\Snapshot\Persist;

use N3ttech\Messaging\Aggregate;
use N3ttech\Messaging\Snapshot\Snapshot;

class InMemorySnapshotRepository implements SnapshotRepository
{
    use Aggregate\AggregateTranslatorTrait;

    /** @var Snapshot\Snapshot[][] */
    private $snapshots = [];

    /**
     * {@inheritdoc}
     */
    public function save(Snapshot\Snapshot $snapshot): void
    {
        $aggregateRoot = $snapshot->getAggregateRoot();
        $aggregateType = Aggregate\AggregateType::fromAggregateRoot($aggregateRoot);
        $aggregateId = $this->getAggregateTranslator()->extractAggregateId($aggregateRoot);

        $this->snapshots[$aggregateType->getAggregateType()][$aggregateId] = $snapshot;
    }

    /**
     * {@inheritdoc}
     */
    public function get(Aggregate\AggregateType $aggregateType, Aggregate\AggregateId $aggregateId): Snapshot\Snapshot
    {
        if (false === isset($this->snapshots[$aggregateType->getAggregateType()][$aggregateId->toString()])) {
            throw new \RuntimeException('Snapshot not found for aggregate: '.$aggregateId->toString());
        }

        return $this->snapshots[$aggregateType->getAggregateType()][$aggregateId];
    }
}
