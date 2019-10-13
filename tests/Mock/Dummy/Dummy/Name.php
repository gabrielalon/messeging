<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Dummy;

class Name
{
	/** @var string */
	private $name;
	
	/**
	 * @param string $name
	 */
	public function __construct(string $name)
	{
		$this->name = $name;
	}
	
	/**
	 * @param string $name
	 * @return Name
	 */
	public static function fromString(string $name): Name
	{
		return new static($name);
	}
	
	/**
	 * @return string
	 */
	public function toString(): string
	{
		return $this->name;
	}
}