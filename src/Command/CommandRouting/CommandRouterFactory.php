<?php

namespace N3ttech\Messaging\Command\CommandRouting;

use N3ttech\Messaging\Command\CommandHandling\CommandHandlerProvider;
use N3ttech\Messaging\Command\NamingStrategy\CommandHandlerSuffixNamingStrategy;
use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;

class CommandRouterFactory
{
    /** @var CommandHandlerProvider */
    private $handlerProvider;

    /**
     * @param CommandHandlerProvider $handlerProvider
     */
    public function __construct(CommandHandlerProvider $handlerProvider)
    {
        $this->handlerProvider = $handlerProvider;
    }

    /**
     * @return CommandRouter
     */
    public function createDefault(): CommandRouter
    {
        return $this->create(new CommandHandlerSuffixNamingStrategy());
    }

    /**
     * @param NamingStrategy $namingStrategy
     *
     * @return CommandRouter
     */
    public function create(NamingStrategy $namingStrategy): CommandRouter
    {
        return new CommandRouter($this->handlerProvider, $namingStrategy);
    }
}
