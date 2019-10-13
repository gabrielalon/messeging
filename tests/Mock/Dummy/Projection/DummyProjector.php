<?php

namespace N3tt3ch\Messaging\Test\Mock\Dummy\Projection;

use N3tt3ch\Messaging\Message\EventSourcing\EventProjector;
use N3tt3ch\Messaging\Test\Mock\Dummy\Event\NewDummyCreate;

class DummyProjector implements EventProjector
{
	public function onNewDummyCreate(NewDummyCreate $event): void
	{
	
	}
}