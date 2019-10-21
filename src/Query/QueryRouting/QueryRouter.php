<?php

namespace N3ttech\Messaging\Query\QueryRouting;

use N3ttech\Messaging\Message\Messaging\MessageHandler;
use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;
use N3ttech\Messaging\Message\Routing\MessageRouter;
use N3ttech\Messaging\Query\QueryHandling\QueryHandlerProvider;

final class QueryRouter implements MessageRouter
{
    /** @var NamingStrategy */
    private $namingStrategy;

    /** @var QueryHandlerProvider */
    private $handlerProvider;

    /**
     * @param QueryHandlerProvider $handlerProvider
     * @param NamingStrategy       $namingStrategy
     */
    public function __construct(
        QueryHandlerProvider $handlerProvider,
        NamingStrategy $namingStrategy
    ) {
        $this->namingStrategy = $namingStrategy;
        $this->handlerProvider = $handlerProvider;
    }

    /**
     * @param string $queryName
     *
     * @return MessageHandler
     */
    public function map(string $queryName): MessageHandler
    {
        $handlerClass = $this->namingStrategy->retrieveName($queryName);

        // @var MessageHandler $handler
        return $this->handlerProvider->retrieve($handlerClass);
    }
}
