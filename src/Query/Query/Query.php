<?php

namespace N3tt3ch\Messaging\Query\Query;

use N3tt3ch\Messaging\Message\Domain\Message;

abstract class Query implements Message
{
	/**
	 * {@inheritDoc}
	 */
	public function messageName(): string
	{
		return get_called_class();
	}
	
	/**
	 * @return string
	 */
	public function queryName(): string
	{
		return $this->messageName();
	}
}
