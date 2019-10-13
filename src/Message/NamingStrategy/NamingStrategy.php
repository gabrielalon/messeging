<?php

namespace N3tt3ch\Messaging\Message\NamingStrategy;

interface NamingStrategy
{
	/**
	 * @param string $messageName
	 * @return string
	 */
	public function retrieveName(string $messageName): string;
}