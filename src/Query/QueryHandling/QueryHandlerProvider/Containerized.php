<?php

namespace N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;

use N3ttech\Messaging\Query\QueryHandling\QueryHandler;
use N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;
use Psr\Container\ContainerInterface;

class Containerized implements QueryHandlerProvider
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve(string $queryHandlerName): QueryHandler
    {
        return $this->container->get($queryHandlerName);
    }
}
