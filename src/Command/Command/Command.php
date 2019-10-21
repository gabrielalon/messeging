<?php

namespace N3ttech\Messaging\Command\Command;

use N3ttech\Messaging\Message\Domain\Message;

abstract class Command implements Message
{
    /**
     * {@inheritdoc}
     */
    public function messageName(): string
    {
        return \get_called_class();
    }
}
