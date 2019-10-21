<?php

namespace N3ttech\Messaging\Command\CommandTransporting;

use N3ttech\Messaging\Command\Command\Command;
use N3ttech\Messaging\Command\CommandRouting\CommandRouter;
use N3ttech\Messaging\Message\Domain\Message;
use N3ttech\Messaging\Message\Transporting\Driver;

final class CommandInMemoryDriver implements Driver
{
    /** @var CommandRouter */
    private $router;

    /** @var Command[]|Message[] */
    private $commands = [];

    /**
     * @param CommandRouter $router
     */
    public function __construct(CommandRouter $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function publish(Message $command): bool
    {
        // @var Command $command
        $this->commands[$command->messageName()] = $command;

        return $this->consume($command->messageName());
    }

    /**
     * {@inheritdoc}
     */
    public function consume(string $commandName): bool
    {
        try {
            $command = $this->retrieve($commandName);
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        $this->release($command->messageName());
        $this->router->map($command->messageName())->run($command);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function release(string $key): void
    {
        unset($this->commands[$key]);
    }

    /**
     * @param string $key
     *
     * @throws \InvalidArgumentException
     *
     * @return Command|Message
     */
    private function retrieve(string $key): Message
    {
        if (false === isset($this->commands[$key])) {
            throw new \InvalidArgumentException(sprintf(
                'Command %s does not exists in memory!',
                $key
            ));
        }

        return $this->commands[$key];
    }
}
