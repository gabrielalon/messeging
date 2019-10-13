<?php

namespace N3tt3ch\Messaging\Query\NamingStrategy;

use N3tt3ch\Messaging\Message\NamingStrategy\NamingStrategy;

final class QueryHandlerSuffixNamingStrategy implements NamingStrategy
{
	const SUFFIX_CLASS_HANDLER = 'Handler';
	
	/**
	 * {@inheritDoc}
	 */
	public function retrieveName(string $queryName): string
	{
		return $queryName . static::SUFFIX_CLASS_HANDLER;
	}
}