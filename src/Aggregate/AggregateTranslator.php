<?php

namespace N3ttech\Messaging\Aggregate;

use N3ttech\Messaging\Aggregate\EventBridge\AggregateChanged;
use N3ttech\Messaging\Aggregate\EventBridge\AggregateRootDecorator;

class AggregateTranslator
{
    /** @var AggregateRootDecorator */
    protected $aggregateRootDecorator;

    /**
     * @return AggregateTranslator
     */
    public static function newInstance(): self
    {
        return new static();
    }

    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return string
     */
    public function extractAggregateId(AggregateRoot $aggregateRoot): string
    {
        return $this->getAggregateRootDecorator()->extractAggregateId($aggregateRoot)->toString();
    }

    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return int
     */
    public function extractAggregateVersion(AggregateRoot $aggregateRoot): int
    {
        return $this->getAggregateRootDecorator()->extractAggregateVersion($aggregateRoot);
    }

    /**
     * @param AggregateType $aggregateType
     * @param \Iterator     $historyEvents
     *
     * @return AggregateRoot
     */
    public function reconstituteAggregateFromHistory(AggregateType $aggregateType, \Iterator $historyEvents): AggregateRoot
    {
        return $this->getAggregateRootDecorator()
            ->fromHistory($aggregateType->getAggregateType(), $historyEvents)
        ;
    }

    /**
     * @return AggregateChanged[]
     */
    public function extractPendingStreamEvents(AggregateRoot $aggregateRoot): array
    {
        return $this->getAggregateRootDecorator()
            ->extractRecordedEvents($aggregateRoot)
        ;
    }

    /**
     * @param AggregateRoot $aggregateRoot
     * @param \Iterator     $events
     */
    public function replayStreamEvents(AggregateRoot $aggregateRoot, \Iterator $events): void
    {
        $this->getAggregateRootDecorator()->replayStreamEvents($aggregateRoot, $events);
    }

    /**
     * @return AggregateRootDecorator
     */
    public function getAggregateRootDecorator(): AggregateRootDecorator
    {
        if (null === $this->aggregateRootDecorator) {
            $this->aggregateRootDecorator = AggregateRootDecorator::newInstance();
        }

        return $this->aggregateRootDecorator;
    }
}
