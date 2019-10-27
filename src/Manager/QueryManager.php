<?php

namespace N3ttech\Messaging\Manager;

use N3ttech\Messaging\Query\Query\Query;
use N3ttech\Messaging\Query\QueryHandling\QueryBus;

class QueryManager
{
    /** @var QueryBus */
    private $queryBus;

    /**
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @param Query $query
     */
    public function ask(Query $query): void
    {
        $this->queryBus->dispatch($query);
    }
}
