<?php

namespace N3ttech\Messaging\Event\NamingStrategy;

use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;

final class EventOnPrefixNamingStrategy implements NamingStrategy
{
    const PREFIX_METHOD_CALL = 'on';

    /**
     * {@inheritdoc}
     */
    public function retrieveName(string $eventName): string
    {
        $reflectionClass = new \ReflectionClass($eventName);

        return self::PREFIX_METHOD_CALL.$reflectionClass->getShortName();
    }
}
