<?php

namespace N3ttech\Messaging\Command\CommandHandling;

interface CommandHandlerProvider
{
    /**
     * @param string $commandHandlerName
     *
     * @return CommandHandler
     */
    public function retrieve(string $commandHandlerName): CommandHandler;
}
