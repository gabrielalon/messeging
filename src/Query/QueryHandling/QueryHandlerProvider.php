<?php

namespace N3ttech\Messaging\Query\QueryHandling;

interface QueryHandlerProvider
{
    public function retrieve(string $queryHandlerName): QueryHandler;
}
