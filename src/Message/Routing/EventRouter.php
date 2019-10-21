<?php

namespace N3ttech\Messaging\Message\Routing;

interface EventRouter extends Router
{
    /**
     * @param string $eventName
     *
     * @return string[]
     */
    public function map(string $eventName): array;
}
