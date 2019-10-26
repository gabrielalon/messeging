<?php

namespace N3ttech\Messaging\Aggregate\Persist;

use N3ttech\Messaging\Aggregate;
use N3ttech\Messaging\Event\EventStore\EventStorage;
use N3ttech\Messaging\Snapshot\SnapshotStore\SnapshotStorage;
use N3ttech\Valuing\Identity\AggregateId;

abstract class AggregateRepository
{
    use Aggregate\AggregateTranslatorTrait;

    /** @var Aggregate\AggregateType */
    protected $aggregateType;

    /** @var EventStorage */
    protected $eventStorage;

    /** @var SnapshotStorage */
    protected $snapshotStorage;

    /**
     * @param EventStorage    $eventStorage
     * @param SnapshotStorage $snapshotStorage
     */
    public function __construct(
        EventStorage $eventStorage,
        SnapshotStorage $snapshotStorage
    ) {
        $this->eventStorage = $eventStorage;
        $this->snapshotStorage = $snapshotStorage;

        $this->aggregateType = Aggregate\AggregateType::fromAggregateRootClass($this->getAggregateRootClass());
    }

    /**
     * @return string
     */
    abstract public function getAggregateRootClass(): string;

    /**
     * @param Aggregate\AggregateRoot $aggregateRoot
     *
     * @throws \Exception
     */
    protected function saveAggregateRoot(Aggregate\AggregateRoot $aggregateRoot): void
    {
        /** @var Aggregate\EventBridge\AggregateChanged $aggregateChanged */
        foreach ($this->getAggregateTranslator()->extractPendingStreamEvents($aggregateRoot) as $aggregateChanged) {
            $this->eventStorage->release($aggregateChanged)->record();
        }

        $this->snapshotStorage->make($aggregateRoot);
    }

    /**
     * @param AggregateId $aggregateId
     *
     * @return Aggregate\AggregateRoot
     */
    protected function findAggregateRoot(AggregateId $aggregateId): Aggregate\AggregateRoot
    {
        $snapshot = $this->snapshotStorage->get($this->aggregateType, $aggregateId);

        $aggregateRoot = $snapshot->getAggregateRoot();
        $events = $this->eventStorage->load($aggregateId, $snapshot->getLastVersion() + 1);

        if ($aggregateRoot instanceof Aggregate\AggregateRoot) {
            $this->getAggregateTranslator()
                ->replayStreamEvents($aggregateRoot, $events)
            ;
        } else {
            $this->completeEmptyEventsWithAggregateRoot($events, $aggregateId);

            $aggregateRoot = $this->getAggregateTranslator()
                ->reconstituteAggregateFromHistory($this->aggregateType, $events)
            ;
        }

        return $aggregateRoot;
    }

    /**
     * @param \ArrayIterator $events
     * @param AggregateId    $aggregateId
     */
    protected function completeEmptyEventsWithAggregateRoot(\ArrayIterator $events, AggregateId $aggregateId): void
    {
        if (0 === $events->count()) {
            $events->append(Aggregate\EventBridge\EmptyAggregateChanged::fromEventStreamData($aggregateId, [], []));
        }
    }
}
