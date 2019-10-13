<?php

namespace N3tt3ch\Messaging\Aggregate\Persist;

use N3tt3ch\Messaging\Aggregate;
use N3tt3ch\Messaging\Event\EventStore\EventStorage;
use N3tt3ch\Messaging\Snapshot\SnapshotStore\SnapshotStorage;

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
	 * @param EventStorage $eventStorage
	 * @param SnapshotStorage $snapshotStorage
	 */
    public function __construct(
    	EventStorage $eventStorage,
		SnapshotStorage $snapshotStorage
	) {
        $this->eventStorage = $eventStorage;
        $this->snapshotStorage = $snapshotStorage;

        $this->initAggregateType();
    }
	
	/**
	 * @return string
	 */
    abstract public function getAggregateRootClass(): string;
	
    private function initAggregateType(): void
    {
        $this->aggregateType = Aggregate\AggregateType::fromAggregateRootClass($this->getAggregateRootClass());
    }
	
	/**
	 * @param Aggregate\AggregateRoot $aggregateRoot
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
	 * @param Aggregate\AggregateId $aggregateId
	 * @return Aggregate\AggregateRoot
	 */
    protected function findAggregateRoot(Aggregate\AggregateId $aggregateId): Aggregate\AggregateRoot
    {
        $snapshot = $this->snapshotStorage->get($this->aggregateType, $aggregateId);

        $aggregateRoot = $snapshot->getAggregateRoot();
        $events = $this->eventStorage->load($aggregateId, $snapshot->getLastVersion() + 1);

        if ($aggregateRoot instanceof Aggregate\AggregateRoot) {
            $this->getAggregateTranslator()
                ->replayStreamEvents($aggregateRoot, $events);
        } else {
            $this->completeEmptyEventsWithAggregateRoot($events, $aggregateId);

            $aggregateRoot = $this->getAggregateTranslator()
                ->reconstituteAggregateFromHistory($this->aggregateType, $events);
        }

        return $aggregateRoot;
    }
	
	/**
	 * @param \ArrayIterator $events
	 * @param Aggregate\AggregateId $aggregateId
	 */
    protected function completeEmptyEventsWithAggregateRoot(\ArrayIterator $events, Aggregate\AggregateId $aggregateId): void
    {
        if (0 === $events->count()) {
            $events->append(Aggregate\EventBridge\EmptyAggregateChanged::fromEventStreamData($aggregateId->toString(), [], []));
        }
    }
}
