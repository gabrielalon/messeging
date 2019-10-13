<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy;

use N3tt3ch\Messaging\Aggregate\AggregateRoot;
use N3tt3ch\Messaging\Test\Mock\Dummy\Event\NewDummyCreate;

class Dummy extends AggregateRoot
{
	/** @var Dummy\Name */
	private $name;
	
	/**
	 * @param Dummy\ID $id
	 */
	public function __construct(Dummy\ID $id)
	{
		$this->aggregateId = $id;
	}
	
	/**
	 * @param Dummy\Name $name
	 */
	public function setName(Dummy\Name $name): void
	{
		$this->name = $name;
	}
	
	/**
	 * @param Dummy\ID $id
	 * @param Dummy\Name $name
	 * @return static
	 */
	public static function createNew(
		Dummy\ID $id,
		Dummy\Name $name
	) {
		$static = new static($id);
		$static->recordThat(NewDummyCreate::occur($static->aggregateId(), [
			'name' => $name->toString()
		]));
		
		return $static;
	}
}