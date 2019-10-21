<?php

namespace N3ttech\Messaging\Command;

use N3ttech\Messaging\Command\Command\Command;
use N3ttech\Messaging\Message\Transporting\Transporter;

class CommandBus implements \N3ttech\Messaging\Command\CommandHandling\CommandBus
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
    public function dispatch(Command $command): void
    {
        $this->transporter->publish($command);
    }
}
