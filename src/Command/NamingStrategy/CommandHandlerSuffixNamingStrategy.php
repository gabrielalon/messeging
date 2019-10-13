<?php

namespace N3tt3ch\Messaging\Command\NamingStrategy;

use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;

final class CommandHandlerSuffixNamingStrategy implements NamingStrategy
{
	const SUFFIX_CLASS_HANDLER = 'Handler';
	
	/**
	 * {@inheritDoc}
	 */
	public function retrieveName(string $messageName): string
	{
		return $messageName . static::SUFFIX_CLASS_HANDLER;
	}
}