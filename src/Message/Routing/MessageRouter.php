<?php

namespace N3tt3ch\Messaging\Message\Routing;

use N3tt3ch\Messaging\Message\Messaging\MessageHandler;

interface MessageRouter extends Router
{
	/**
	 * @param string $messageName
	 * @return MessageHandler
	 */
	public function map(string $messageName): MessageHandler;
}
