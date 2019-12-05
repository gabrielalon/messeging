<?php

namespace N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;

use N3ttech\Messaging\Query\QueryHandling\QueryHandler;
use N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;

class RegistryProvider implements QueryHandlerProvider
{
    /** @var QueryHandler[] */
    private $queryHandlers = [];

    /**
     * @param string       $queryHandlerName
     * @param QueryHandler $queryHandler
     */
    public function register(string $queryHandlerName, QueryHandler $queryHandler): void
    {
        $this->queryHandlers[$queryHandlerName] = $queryHandler;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve(string $queryHandlerName): QueryHandler
    {
        if (false === isset($this->queryHandlers[$queryHandlerName])) {
            throw new \InvalidArgumentException(\sprintf('Query handler for name %s is not registered.', $queryHandlerName));
        }

        return $this->queryHandlers[$queryHandlerName];
    }
}
