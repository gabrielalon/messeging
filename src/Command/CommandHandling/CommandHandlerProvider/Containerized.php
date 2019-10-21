<?php

namespace N3ttech\Messaging\Command\CommandHandling\CommandHandlerProvider;

use N3ttech\Messaging\Command\CommandHandling\CommandHandler;
use N3ttech\Messaging\Command\CommandHandling\CommandHandlerProvider;
use Psr\Container\ContainerInterface;

class Containerized implements CommandHandlerProvider
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
    public function retrieve(string $commandHandlerName): CommandHandler
    {
        return $this->container->get($commandHandlerName);
    }
}
