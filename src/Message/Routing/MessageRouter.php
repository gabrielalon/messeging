<?php

namespace N3ttech\Messaging\Message\Routing;

use N3ttech\Messaging\Message\Messaging\MessageHandler;

interface MessageRouter extends Router
{
    /**
     * @param string $messageName
     *
     * @return MessageHandler
     */
    public function map(string $messageName): MessageHandler;
}
