<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Dummy;

use N3tt3ch\Messaging\Aggregate\AggregateId;

class ID implements AggregateId
{
	/** @var string */
	private $id;
	
	/**
	 * @param string $id
	 */
	public function __construct(string $id)
	{
		$this->id = $id;
	}
	
	/**
	 * @param string $id
	 * @return ID
	 */
	public static function fromId(string $id): ID
	{
		return new static($id);
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->id;
	}
}