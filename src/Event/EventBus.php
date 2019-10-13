<?php

namespace N3tt3ch\Messaging\Event;

use N3tt3ch\Messaging\Event\Event\Event;
use N3tt3ch\Messaging\Message\Transporting\Transporter;

class EventBus implements \N3tt3ch\Messaging\Event\EventSourcing\EventBus
{
	/** @var Transporter */
	private $transporter;
	
	/**
	 * @param Transporter $transporter
	 */
	public function __construct(Transporter $transporter)
	{
		$this->transporter = $transporter;
	}
	
	/**
	 * @param Event $event
	 */
	public function dispatch(Event $event): void
	{
		$this->transporter->publish($event);
	}
}