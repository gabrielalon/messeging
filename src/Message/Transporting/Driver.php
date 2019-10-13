<?php

namespace N3tt3ch\Messaging\Message\Transporting;

use N3tt3ch\Messaging\Message\Domain\Message;

interface Driver
{
	/**
	 * @param Message $message
	 * @return bool
	 */
	public function publish(Message $message): bool;
	
	/**
	 * @param string $key
	 * @return bool
	 */
	public function consume(string $key): bool;
	
	/**
	 * @param string $key
	 */
	public function release(string $key): void;
}