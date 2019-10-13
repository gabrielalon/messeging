<?php

namespace N3tt3ch\Messaging\Event\NamingStrategy;

use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;

final class EventOnPrefixNamingStrategy implements NamingStrategy
{
	const PREFIX_METHOD_CALL = 'on';
	
	/**
	 * {@inheritDoc}
	 */
	public function retrieveName(string $eventName): string
	{
		return self::PREFIX_METHOD_CALL . $eventName;
	}
}