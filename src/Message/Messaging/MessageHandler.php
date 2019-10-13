<?php

namespace N3tt3ch\Messaging\Message\Messaging;

use N3tt3ch\Messaging\Message\Domain\Message;

interface MessageHandler
{
	/**
	 * @param Message $message
	 */
    public function run(Message $message): void;
}
