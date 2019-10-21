<?php

namespace N3ttech\Messaging\Query;

use N3ttech\Messaging\Message\Transporting\Transporter;

class QueryBus implements \N3ttech\Messaging\Query\QueryHandling\QueryBus
{
    /** @var Transporter */
    private $transporter;

    /**
     * {@inheritdoc}
     */
    public function __construct(Transporter $transporter)
    {
        $this->transporter = $transporter;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(Query\Query $query): void
    {
        $this->transporter->publish($query);
    }
}
