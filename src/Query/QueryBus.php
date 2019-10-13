<?php

namespace N3tt3ch\Messaging\Query;

use N3tt3ch\Messaging\Message\Transporting\Transporter;

class QueryBus implements \N3tt3ch\Messaging\Query\QueryHandling\QueryBus
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
	 * @param Query\Query $query
	 */
	public function dispatch(Query\Query $query): void
	{
		$this->transporter->publish($query);
	}
}