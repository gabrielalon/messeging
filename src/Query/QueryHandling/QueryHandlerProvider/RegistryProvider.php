<?php

namespace N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;

use N3ttech\Messaging\Query\QueryHandling\QueryHandler;
use N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;

class RegistryProvider implements QueryHandlerProvider
{
    /** @var QueryHandler[] */
    private $queryHandlers = [];

    /**
     * @param QueryHandler $queryHandler
     */
    public function register(QueryHandler $queryHandler): void
    {
        $queryHandlerName = get_class($queryHandler);
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
