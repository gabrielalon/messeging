<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Query;

use N3tt3ch\Messaging\Test\Mock\Dummy\Query\Exception\DummyNotFoundException;
use N3tt3ch\Messaging\Test\Mock\Dummy\Query\ReadModel\Dummy;
use N3tt3ch\Messaging\Test\Mock\Dummy\Query\V1\FindByID;

class DummyQuery implements \N3tt3ch\Messaging\Test\Mock\Dummy\Query\V1\DummyQuery
{
	
	/**
	 * @param FindByID $query
	 * @return Dummy
	 * @throws DummyNotFoundException
	 */
	public function findByID(FindByID $query): Dummy
	{
		// TODO: Implement findByID() method.
	}
}