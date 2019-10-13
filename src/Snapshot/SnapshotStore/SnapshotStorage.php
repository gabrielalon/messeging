<?php

namespace N3tt3ch\Messaging\Snapshot\SnapshotStore;

use N3tt3ch\Messaging\Aggregate;
use N3tt3ch\Messaging\Snapshot\Persist\SnapshotRepository;
use N3tt3ch\Messaging\Snapshot\Snapshot\Snapshot;

class SnapshotStorage
{
    use Aggregate\AggregateTranslatorTrait;

    /** @var SnapshotRepository */
    private $snapshotRepository;
	
	/**
	 * @param SnapshotRepository $snapshotRepository
	 */
    public function __construct(SnapshotRepository $snapshotRepository)
	{
        $this->snapshotRepository = $snapshotRepository;
    }
	
	/**
	 * @param Aggregate\AggregateRoot $aggregateRoot
	 * @throws \Exception
	 */
    public function make(Aggregate\AggregateRoot $aggregateRoot): void
    {
        $this->snapshotRepository->save(new Snapshot(
			$aggregateRoot,
			$this->getAggregateTranslator()->extractAggregateVersion($aggregateRoot),
			new \DateTime('now')
		));
    }
	
	/**
	 * @param Aggregate\AggregateType $aggregateType
	 * @param Aggregate\AggregateId $aggregateId
	 * @return Snapshot
	 */
    public function get(Aggregate\AggregateType $aggregateType, Aggregate\AggregateId $aggregateId)
    {
        return $this->snapshotRepository->get($aggregateType, $aggregateId);
    }
}