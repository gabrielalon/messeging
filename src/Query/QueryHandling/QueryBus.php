<?php

namespace N3tt3ch\Messaging\Query\QueryHandling;

use N3tt3ch\Messaging\Message\Messaging\MessageBus;
use N3tt3ch\Messaging\Query\Query;

interface QueryBus extends MessageBus
{
	/**
	 * @param Query\Query $query
	 */
    public function dispatch(Query\Query $query): void;
}
