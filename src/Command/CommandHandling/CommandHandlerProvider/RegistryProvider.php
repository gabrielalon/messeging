<?php

namespace N3ttech\Messaging\Command\CommandHandling\CommandHandlerProvider;

use N3ttech\Messaging\Command\CommandHandling\CommandHandler;
use N3ttech\Messaging\Command\CommandHandling\CommandHandlerProvider;

class RegistryProvider implements CommandHandlerProvider
{
    /** @var CommandHandler[] */
    private $commandHandlers = [];

    /**
     * @param string         $commandHandlerName
     * @param CommandHandler $commandHandler
     */
    public function register(string $commandHandlerName, CommandHandler $commandHandler): void
    {
        $this->commandHandlers[$commandHandlerName] = $commandHandler;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve(string $commandHandlerName): CommandHandler
    {
        if (false === isset($this->commandHandlers[$commandHandlerName])) {
            throw new \InvalidArgumentException(\sprintf('Command handler for name %s is not registered.', $commandHandlerName));
        }

        return $this->commandHandlers[$commandHandlerName];
    }
}
