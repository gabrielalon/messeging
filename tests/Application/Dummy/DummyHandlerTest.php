<?php

namespace N3tt3ch\Messaging\Test\Application\Dummy;

use N3tt3ch\Messaging\Command\CommandBus;
use N3tt3ch\Messaging\Test\Application\TestCase;
use N3tt3ch\Messaging\Test\Mock\Dummy\Command\CreateDummy;

class DummyHandlerTest extends TestCase
{
	public function it_creates_dummy()
	{
		//given
		$name = 'dummy';
		$uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
		
		$command = new CreateDummy($uuid, $name);
		
		/** @var CommandBus $bus */
		$bus = $this->getFromContainer(CommandBus::class);
		$bus->dispatch($command);
	}
}