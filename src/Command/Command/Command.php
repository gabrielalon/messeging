<?php

namespace N3tt3ch\Messaging\Command\Command;

use N3tt3ch\Messaging\Message\Domain\Message;

abstract class Command implements Message
{
	/**
	 * @return string
	 */
	public function messageName(): string
	{
		return get_called_class();
	}
	
	/**
	 * @return string
	 */
	public function commandName(): string
	{
		return $this->messageName();
	}
}
