<?php

namespace N3ttech\Messaging\Aggregate\EventBridge;

use N3ttech\Messaging\Aggregate\AggregateRoot;
use N3ttech\Valuing\Identity\AggregateId;

class AggregateRootDecorator extends AggregateRoot
{
    /**
     * @return AggregateRootDecorator
     */
    public static function newInstance(): self
    {
        return new static();
    }

    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return int
     */
    public function extractAggregateVersion(AggregateRoot $aggregateRoot): int
    {
        return $aggregateRoot->version;
    }

    /**
     * @return AggregateChanged[]
     */
    public function extractRecordedEvents(AggregateRoot $aggregateRoot): array
    {
        return $aggregateRoot->popRecordedEvents();
    }

    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return AggregateId
     */
    public function extractAggregateId(AggregateRoot $aggregateRoot): AggregateId
    {
        return $aggregateRoot->aggregateId;
    }

    /**
     * @param string    $aggregateRootClass
     * @param \Iterator $aggregateChangedEvents
     *
     * @return AggregateRoot
     */
    public function fromHistory(string $aggregateRootClass, \Iterator $aggregateChangedEvents): AggregateRoot
    {
        if (false === class_exists($aggregateRootClass)) {
            throw new \RuntimeException(sprintf(
                'Aggregate root class %s cannot be found',
                $aggregateRootClass
            ));
        }

        // @var AggregateRoot $aggregateRootClass
        return $aggregateRootClass::reconstituteFromHistory($aggregateChangedEvents);
    }

    /**
     * @param AggregateRoot $aggregateRoot
     * @param \Iterator     $events
     */
    public function replayStreamEvents(AggregateRoot $aggregateRoot, \Iterator $events): void
    {
        $aggregateRoot->replay($events);
    }

    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        // don't apply on decorator
    }
}
