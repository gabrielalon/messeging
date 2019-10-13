<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Query\V1;

use N3tt3ch\Messaging\Test\Mock\Dummy\Query\Exception\DummyNotFoundException;
use N3tt3ch\Messaging\Test\Mock\Dummy\Query\ReadModel\Dummy;

interface DummyQuery
{
	/**
	 * @param FindByID $query
	 * @return Dummy
	 * @throws DummyNotFoundException
	 */
	public function findByID(FindByID $query): Dummy;
}