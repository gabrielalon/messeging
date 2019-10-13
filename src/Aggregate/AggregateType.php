<?php

namespace N3tt3ch\Messaging\Aggregate;

class AggregateType
{
    /** @var string */
    protected $aggregateType;
	
	/**
	 * @param AggregateRoot $aggregateRoot
	 * @return AggregateType
	 */
    public static function fromAggregateRoot(AggregateRoot $aggregateRoot): AggregateType
    {
        return static::fromAggregateRootClass(\get_class($aggregateRoot));
    }
	
	/**
	 * @param string $aggregateRootClass
	 * @return AggregateType
	 */
    public static function fromAggregateRootClass(string $aggregateRootClass): AggregateType
    {
        if (false === class_exists($aggregateRootClass)) {
            throw new \InvalidArgumentException(sprintf('Aggregate root class %s can not be found', $aggregateRootClass));
        }

        $self = new static();
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
