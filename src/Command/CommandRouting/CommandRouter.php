<?php

namespace N3ttech\Messaging\Command\CommandRouting;

use N3ttech\Messaging\Command\CommandHandling\CommandHandlerProvider;
use N3ttech\Messaging\Message\Messaging\MessageHandler;
use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;
use N3ttech\Messaging\Message\Routing\MessageRouter;

final class CommandRouter implements MessageRouter
{
    /** @var NamingStrategy */
    private $namingStrategy;

    /** @var CommandHandlerProvider */
    private $handlerProvider;

    /**
     * @param CommandHandlerProvider $handlerProvider
     * @param NamingStrategy         $namingStrategy
     */
    public function __construct(
        CommandHandlerProvider $handlerProvider,
        NamingStrategy $namingStrategy
    ) {
        $this->namingStrategy = $namingStrategy;
        $this->handlerProvider = $handlerProvider;
    }

    /**
     * @param string $messageName
     *
     * @return MessageHandler
     */
    public function map(string $messageName): MessageHandler
    {
        $handlerClass = $this->namingStrategy->retrieveName($messageName);

        // @var MessageHandler $handler
        return $this->handlerProvider->retrieve($handlerClass);
    }
}
