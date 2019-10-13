<?php

namespace N3tt3ch\Messaging\Message\Messaging;

interface MessageHandlerProvider
{
	/**
	 * @param string $messageHandlerName
	 * @return MessageHandler
	 */
	public function retrieve(string $messageHandlerName): MessageHandler;
}