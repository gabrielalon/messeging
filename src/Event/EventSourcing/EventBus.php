<?php

namespace N3tt3ch\Messaging\Event\EventSourcing;

use N3tt3ch\Messaging\Event\Event\Event;
use N3tt3ch\Messaging\Message\Messaging\MessageBus;

interface EventBus extends MessageBus
{
	/**
	 * @param Event $event
	 */
    public function dispatch(Event $event): void;
}
