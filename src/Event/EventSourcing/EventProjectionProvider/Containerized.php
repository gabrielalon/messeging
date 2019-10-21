<?php

namespace N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;

use N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;
use N3ttech\Messaging\Message\EventSourcing\EventProjector;
use Psr\Container\ContainerInterface;

class Containerized implements EventProjectionProvider
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
    public function retrieve(string $projectionName): EventProjector
    {
        return $this->container->get($projectionName);
    }
}
