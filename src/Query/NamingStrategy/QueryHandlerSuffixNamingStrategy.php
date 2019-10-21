<?php

namespace N3ttech\Messaging\Query\NamingStrategy;

use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;

final class QueryHandlerSuffixNamingStrategy implements NamingStrategy
{
    const SUFFIX_CLASS_HANDLER = 'Handler';

    /**
     * {@inheritdoc}
     */
    public function retrieveName(string $queryName): string
    {
        return $queryName.static::SUFFIX_CLASS_HANDLER;
    }
}
