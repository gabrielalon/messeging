<?php

namespace N3ttech\Messaging\Message\Transporting;

use N3ttech\Messaging\Message\Domain\Message;

interface Driver
{
    /**
     * @param Message $message
     *
     * @return bool
     */
    public function publish(Message $message): bool;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function consume(string $key): bool;

    /**
     * @param string $key
     */
    public function release(string $key): void;
}
