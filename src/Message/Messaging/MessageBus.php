<?php

namespace N3tt3ch\Messaging\Message\Messaging;

use N3tt3ch\Messaging\Message\Transporting\Transporter;

interface MessageBus
{
	/**
	 * @param Transporter $transporter
	 */
    public function __construct(Transporter $transporter);
}
