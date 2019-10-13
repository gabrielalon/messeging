<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Event;

use N3tt3ch\Messaging\Aggregate\AggregateRoot;
use N3tt3ch\Messaging\Aggregate\EventBridge\AggregateChanged;
use N3tt3ch\Messaging\Test\Mock\Dummy\Dummy;

class NewDummyCreate extends AggregateChanged
{
	/**
	 * @return Dummy\Name
	 */
	public function dummyName(): Dummy\Name
	{
		return Dummy\Name::fromString(isset($this->payload['name']) ? $this->payload['name'] : '');
	}
	/**
	 * @param AggregateRoot|Dummy $dummy
	 */
	public function populate(AggregateRoot $dummy): void
	{
		$dummy->setAggregateId(Dummy\Id::fromId($this->aggregateId()));
		$dummy->setName($this->dummyName());
	}
}