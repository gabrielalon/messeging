<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Command;

use N3tt3ch\Messaging\Command\Command\Command;

class CreateDummy extends Command
{
	/** @var string */
	private $id;
	
	/** @var string */
	private $name;
	
	/**
	 * @param string $id
	 * @param string $name
	 */
	public function __construct(string $id, string $name)
	{
		$this->id = $id;
		$this->name = $name;
	}
	
	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}