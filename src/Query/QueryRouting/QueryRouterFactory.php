<?php

namespace N3ttech\Messaging\Query\QueryRouting;

use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;
use N3ttech\Messaging\Query\NamingStrategy\QueryHandlerSuffixNamingStrategy;
use N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;

class QueryRouterFactory
{
    /** @var QueryHandlerProvider */
    private $handlerProvider;

    /**
     * @param QueryHandlerProvider $handlerProvider
     */
    public function __construct(QueryHandlerProvider $handlerProvider)
    {
        $this->handlerProvider = $handlerProvider;
    }

    /**
     * @return QueryRouter
     */
    public function createDefault(): QueryRouter
    {
        return $this->create(new QueryHandlerSuffixNamingStrategy());
    }

    /**
     * @param NamingStrategy $namingStrategy
     *
     * @return QueryRouter
     */
    public function create(NamingStrategy $namingStrategy): QueryRouter
    {
        return new QueryRouter($this->handlerProvider, $namingStrategy);
    }
}
