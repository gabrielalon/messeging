<?php

namespace N3ttech\Messaging\Command\CommandHandling;

use N3ttech\Messaging\Command\Command\Command;
use N3ttech\Messaging\Message\Messaging\MessageBus;

interface CommandBus extends MessageBus
{
    /**
     * @param Command $command
     */
    public function dispatch(Command $command): void;
}
