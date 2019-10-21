<?php

namespace N3ttech\Messaging\Aggregate;

class AggregateType
{
    /** @var string */
    protected $aggregateType;

    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return AggregateType
     */
    public static function fromAggregateRoot(AggregateRoot $aggregateRoot): self
    {
        return AggregateType::fromAggregateRootClass(\get_class($aggregateRoot));
    }

    /**
     * @param string $aggregateRootClass
     *
     * @return AggregateType
     */
    public static function fromAggregateRootClass(string $aggregateRootClass): self
    {
        if (false === class_exists($aggregateRootClass)) {
            throw new \InvalidArgumentException(sprintf('Aggregate root class %s can not be found', $aggregateRootClass));
        }

        $self = new AggregateType();
        $self->aggregateType = $aggregateRootClass;

        return $self;
    }

    /**
     * @return string
     */
    public function getAggregateType(): string
    {
        return $this->aggregateType;
    }
}
