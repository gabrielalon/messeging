<?php

namespace N3tt3ch\Messaging\Command\CommandHandling;

use N3tt3ch\Messaging\Command\Command\Command;
use N3tt3ch\Messaging\Message\Messaging\MessageBus;

interface CommandBus extends MessageBus
{
	/**
	 * @param Command $command
	 */
    public function dispatch(Command $command): void;
}
