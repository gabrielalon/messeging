<?php

namespace N3tt3ch\Messaging\Aggregate\EventBridge;

use N3tt3ch\Messaging\Aggregate\AggregateRoot;

class EmptyAggregateChanged extends AggregateChanged
{
    public function populate(AggregateRoot $aggregateRoot): void
    {
        $aggregateRoot->setAggregateId($this->aggregateId());
    }
}
