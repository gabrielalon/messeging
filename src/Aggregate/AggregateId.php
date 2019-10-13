<?php

namespace N3tt3ch\Messaging\Aggregate;

interface AggregateId
{
	/**
	 * @return string
	 */
	public function toString(): string;
}