<?php

namespace N3tt3ch\Messaging\Message\Routing;

interface EventRouter extends Router
{
	/**
	 * @param string $eventName
	 * @return string[]
	 */
	public function map(string $eventName): array;
}