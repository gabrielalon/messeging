<?php

namespace N3tt3ch\Messaging\Event\Event;

use N3tt3ch\Messaging\Message\Domain\Message;

interface Event extends Message
{
	/**
	 * @return string
	 */
	public function eventName(): string;
}
