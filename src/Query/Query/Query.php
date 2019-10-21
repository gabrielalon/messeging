<?php

namespace N3ttech\Messaging\Query\Query;

use N3ttech\Messaging\Message\Domain\Message;

abstract class Query implements Message
{
    /**
     * {@inheritdoc}
     */
    public function messageName(): string
    {
        return \get_called_class();
    }
}
