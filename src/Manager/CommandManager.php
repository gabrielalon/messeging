<?php

namespace N3ttech\Messaging\Manager;

use N3ttech\Messaging\Command\Command\Command;
use N3ttech\Messaging\Command\CommandHandling\CommandBus;

class CommandManager
{
    /** @var CommandBus */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Command $command
     */
    public function command(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
