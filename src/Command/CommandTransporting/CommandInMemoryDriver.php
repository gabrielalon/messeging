<?php

namespace N3tt3ch\Messaging\Command\CommandTransporting;

use N3tt3ch\Messaging\Command\Command\Command;
use N3tt3ch\Messaging\Command\CommandRouting\CommandRouter;
use N3tt3ch\Messaging\Message\Domain\Message;
use N3tt3ch\Messaging\Message\Transporting\Driver;

final class CommandInMemoryDriver implements Driver
{
	/** @var CommandRouter */
	private $router;
	
	/** @var Command[] */
	private $commands = [];
	
	/**
	 * @param CommandRouter $router
	 */
	public function __construct(CommandRouter $router)
	{
		$this->router = $router;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function publish(Message $command): bool
	{
		/** @var Command $command */
		$this->commands[$command->commandName()] = $command;
		
		return $this->consume($command->commandName());
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function consume(string $commandName): bool
	{
		try
		{
			$command = $this->retrieve($commandName);
		} catch (\InvalidArgumentException $e) {
			return false;
		}
		
		$this->release($command->commandName());
		$this->router->map($command->commandName())->run($command);
		
		return true;
	}
	
	/**
	 * @param string $key
	 * @return Command
	 * @throws \InvalidArgumentException
	 */
	private function retrieve(string $key): Command
	{
		if (false === isset($this->commands[$key])) {
			throw new \InvalidArgumentException(\sprintf('Command %s does not exists in memory!',
				$key
			));
		}
		
		return $this->commands[$key];
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function release(string $key): void
	{
		unset($this->commands[$key]);
	}
}