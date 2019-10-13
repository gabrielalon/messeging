<?php

namespace N3tt3ch\Messaging\Command;

use N3tt3ch\Messaging\Command\Command\Command;
use N3tt3ch\Messaging\Message\Transporting\Transporter;

class CommandBus implements \N3tt3ch\Messaging\Command\CommandHandling\CommandBus
{
	/** @var Transporter */
	private $transporter;
	
	/**
	 * @param Transporter $transporter
	 */
	public function __construct(Transporter $transporter)
	{
		$this->transporter = $transporter;
	}
	
	/**
	 * @param Command $command
	 */
	public function dispatch(Command $command): void
	{
		$this->transporter->publish($command);
	}
}