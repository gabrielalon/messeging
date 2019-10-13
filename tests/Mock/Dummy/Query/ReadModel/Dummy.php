<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Query\ReadModel;

use N3tt3ch\Messaging\Query\Query\Viewable;
use N3tt3ch\Messaging\Test\Mock\Dummy\Dummy as VO;

class Dummy implements Viewable
{
	/** @var VO\ID */
	private $id;
	
	/** @var VO\Name */
	private $name;
	
	/**
	 * @param string $id
	 */
	public function __construct(string $id)
	{
		$this->setId(VO\ID::fromId($id));
	}
	
	/**
	 * @param string $id
	 * @return Dummy
	 */
	public static function fromID(string $id): Dummy
	{
		return new static($id);
	}
	
	/**
	 * @return VO\ID
	 */
	public function getId(): VO\ID
	{
		return $this->id;
	}
	
	/**
	 * @param VO\ID $id
	 * @return Dummy
	 */
	public function setId(VO\ID $id): Dummy
	{
		$this->id = $id;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function identifier(): string
	{
		return $this->id->toString();
	}
	
	/**
	 * @return VO\Name
	 */
	public function getName(): VO\Name
	{
		return $this->name;
	}
	
	/**
	 * @param VO\Name $name
	 * @return Dummy
	 */
	public function setName(VO\Name $name): Dummy
	{
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function name(): string
	{
		return $this->name->toString();
	}
}