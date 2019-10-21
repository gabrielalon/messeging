<?php

namespace N3ttech\Messaging\Aggregate;

trait AggregateTranslatorTrait
{
    /** @var AggregateTranslator */
    protected $aggregateTranslator;

    /**
     * @return AggregateTranslator
     */
    protected function getAggregateTranslator()
    {
        if (null === $this->aggregateTranslator) {
            $this->aggregateTranslator = AggregateTranslator::newInstance();
        }

        return $this->aggregateTranslator;
    }
}
