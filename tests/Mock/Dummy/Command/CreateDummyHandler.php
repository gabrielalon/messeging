<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Command;

use N3tt3ch\Messaging\Command\CommandHandling\CommandHandler;
use N3tt3ch\Messaging\Message\Domain\Message;
use N3tt3ch\Messaging\Test\Mock\Dummy\Dummy;
use N3tt3ch\Messaging\Test\Mock\Dummy\Persist\DummyRepository;

class CreateDummyHandler implements CommandHandler
{
	/** @var DummyRepository */
	private $repository;
	
	/**
	 * @param Message|CreateDummy $message
	 */
	public function run(Message $message): void
	{
		$this->repository->save(Dummy::createNew(
			Dummy\ID::fromId($message->getId()),
			Dummy\Name::fromString($message->getName())
		));
	}
}