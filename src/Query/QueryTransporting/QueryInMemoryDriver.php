<?php

namespace N3ttech\Messaging\Query\QueryTransporting;

use N3ttech\Messaging\Message\Domain\Message;
use N3ttech\Messaging\Message\Transporting\Driver;
use N3ttech\Messaging\Query\Query\Query;
use N3ttech\Messaging\Query\QueryRouting\QueryRouter;

final class QueryInMemoryDriver implements Driver
{
    /** @var QueryRouter */
    private $router;

    /** @var Message[]|Query[] */
    private $queries = [];

    /**
     * @param QueryRouter $router
     */
    public function __construct(QueryRouter $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function publish(Message $query): bool
    {
        // @var Query $query
        $this->queries[$query->messageName()] = $query;

        return $this->consume($query->messageName());
    }

    /**
     * {@inheritdoc}
     */
    public function consume(string $queryName): bool
    {
        try {
            $query = $this->retrieve($queryName);
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        $this->release($query->messageName());
        $this->router->map($query->messageName())->run($query);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function release(string $key): void
    {
        unset($this->queries[$key]);
    }

    /**
     * @param string $key
     *
     * @throws \InvalidArgumentException
     *
     * @return Message|Query
     */
    private function retrieve(string $key): Message
    {
        if (false === isset($this->queries[$key])) {
            throw new \InvalidArgumentException(sprintf('Query %s does not exists in memory!', $key));
        }

        return $this->queries[$key];
    }
}
