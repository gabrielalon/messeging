<?php

namespace N3ttech\Messaging\Message\Messaging;

use N3ttech\Messaging\Message\Domain\Message;

interface MessageHandler
{
    /**
     * @param Message $message
     */
    public function run(Message $message): void;
}
