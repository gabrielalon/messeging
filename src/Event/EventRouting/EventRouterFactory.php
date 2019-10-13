<?php

namespace N3tt3ch\Messaging\Event\EventRouting;

class EventRouterFactory
{
	/**
	 * @param string $path
	 * @return EventRouter
	 */
	public function fromDirectory(string $path): EventRouter
	{
		$pathPattern = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		
		$iterator = new \GlobIterator($pathPattern);
		$iterator->rewind();
		
		$map = [];
		while (true === $iterator->valid())
		{
			/** @var string[] $tmp */
			$tmp = include $iterator->current();
			$map = array_merge($map, $tmp);
			
			$iterator->next();
		}
		
		return new EventRouter($map);
	}
}