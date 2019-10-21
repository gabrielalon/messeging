<?php

namespace N3ttech\Messaging\Command\CommandTransporting;

use N3ttech\Messaging\Command\CommandRouting\CommandRouter;
use N3ttech\Messaging\Message\Transporting\Driver;

class CommandTransporterFactory
{
    /** @var CommandRouter */
    private $router;

    /**
     * @param CommandRouter $router
     */
    public function __construct(CommandRouter $router)
    {
        $this->router = $router;
    }

    /**
     * @return CommandTransporter
     */
    public function createDefault(): CommandTransporter
    {
        return $this->create(new CommandInMemoryDriver($this->router));
    }

    /**
     * @param Driver $transportProvider
     *
     * @return CommandTransporter
     */
    public function create(Driver $transportProvider): CommandTransporter
    {
        return new CommandTransporter($transportProvider);
    }
}
