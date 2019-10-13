<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Query\ReadModel;

use N3tt3ch\Messaging\Query\Query\Viewable;
use N3tt3ch\Messaging\Query\Query\ViewableCollection;

class DummyCollection extends \ArrayIterator implements ViewableCollection
{
	/**
	 * @param Viewable $viewable
	 */
	public function add(Viewable $viewable): void
	{
		$this->offsetSet($viewable->identifier(), $viewable);
	}
	
	/**
	 * @return Viewable[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}