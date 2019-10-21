<?php

namespace N3ttech\Messaging\Event\Event;

use N3ttech\Messaging\Message\Domain\Message;

interface Event extends Message
{
    /**
     * @return string
     */
    public function aggregateId(): string;

    /**
     * @return string
     */
    public function eventName(): string;

    /**
     * @return int
     */
    public function version(): int;
}
