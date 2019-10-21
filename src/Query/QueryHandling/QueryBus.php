<?php

namespace N3ttech\Messaging\Query\QueryHandling;

use N3ttech\Messaging\Message\Messaging\MessageBus;
use N3ttech\Messaging\Query\Query;

interface QueryBus extends MessageBus
{
    /**
     * @param Query\Query $query
     */
    public function dispatch(Query\Query $query): void;
}
