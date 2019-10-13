<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Query\V1;

use N3tt3ch\Messaging\Query\Query\Query;

class FindByID extends Query
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
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}
}