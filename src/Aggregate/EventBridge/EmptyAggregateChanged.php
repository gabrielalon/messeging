<?php

namespace N3ttech\Messaging\Aggregate\EventBridge;

use N3ttech\Messaging\Aggregate\AggregateId;
use N3ttech\Messaging\Aggregate\AggregateRoot;

class EmptyAggregateChanged extends AggregateChanged
{
    /** @var AggregateId */
    protected $aggregateId;

    /**
     * @param AggregateId $aggregateId
     * @param array       $payload
     * @param array       $metadata
     *
     * @return EmptyAggregateChanged
     */
    public static function fromEventStreamData(
        AggregateId $aggregateId,
        array $payload,
        array $metadata = []
    ): self {
        $empty = new static($aggregateId->toString(), $payload, $metadata);
        $empty->aggregateId;

        return $empty;
    }

    /**
     * @param AggregateRoot $aggregateRoot
     */
    public function populate(AggregateRoot $aggregateRoot): void
    {
        $aggregateRoot->setAggregateId($this->aggregateId);
    }
}
