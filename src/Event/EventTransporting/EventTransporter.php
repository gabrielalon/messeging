<?php

namespace N3tt3ch\Messaging\Event\EventTransporting;

use N3tt3ch\Messaging\Message\Domain\Message;
use N3tt3ch\Messaging\Message\Transporting;

final class EventTransporter implements Transporting\Transporter
{
	
	/** @var Transporting\Driver $transportProvider */
	private $transportProvider;
	
	/**
	 * @param Transporting\Driver $transportProvider
	 */
	public function __construct(Transporting\Driver $transportProvider)
	{
		$this->transportProvider = $transportProvider;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function publish(Message $message): void
	{
		$this->transportProvider->publish($message);
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function consume(string $key): void
	{
		$this->transportProvider->consume($key);
	}
}