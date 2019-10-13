<?php

namespace N3tt3ch\Messaging\Query\QueryTransporting;

use N3tt3ch\Messaging\Message\Domain\Message;
use N3tt3ch\Messaging\Message\Transporting;

final class QueryTransporter implements Transporting\Transporter
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
	public function publish(Message $query): void
	{
		$this->transportProvider->publish($query);
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function consume(string $key): void
	{
		$this->transportProvider->consume($key);
	}
}