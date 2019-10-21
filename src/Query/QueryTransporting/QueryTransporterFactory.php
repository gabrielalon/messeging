<?php

namespace N3ttech\Messaging\Query\QueryTransporting;

use N3ttech\Messaging\Message\Transporting\Driver;
use N3ttech\Messaging\Query\QueryRouting\QueryRouter;

class QueryTransporterFactory
{
    /** @var QueryRouter */
    private $router;

    /**
     * @param QueryRouter $router
     */
    public function __construct(QueryRouter $router)
    {
        $this->router = $router;
    }

    /**
     * @return QueryTransporter
     */
    public function createDefault(): QueryTransporter
    {
        return $this->create(new QueryInMemoryDriver($this->router));
    }

    /**
     * @param Driver $transportProvider
     *
     * @return QueryTransporter
     */
    public function create(Driver $transportProvider): QueryTransporter
    {
        return new QueryTransporter($transportProvider);
    }
}
