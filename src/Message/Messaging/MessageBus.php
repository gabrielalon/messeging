<?php

namespace N3ttech\Messaging\Message\Messaging;

use N3ttech\Messaging\Message\Transporting\Transporter;

interface MessageBus
{
    /**
     * @param Transporter $transporter
     */
    public function __construct(Transporter $transporter);
}
