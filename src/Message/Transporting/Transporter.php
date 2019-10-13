<?php

namespace N3tt3ch\Messaging\Message\Transporting;

use N3tt3ch\Messaging\Message\Domain\Message;

interface Transporter
{
	/**
	 * @param Driver $provider
	 */
	public function __construct(Driver $provider);
	
	/**
	 * @param Message $message
	 */
	public function publish(Message $message): void;
	
	/**
	 * @param string $key
	 */
	public function consume(string $key): void;
}