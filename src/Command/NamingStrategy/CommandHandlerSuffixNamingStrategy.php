<?php

namespace N3ttech\Messaging\Command\NamingStrategy;

use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;

final class CommandHandlerSuffixNamingStrategy implements NamingStrategy
{
    const SUFFIX_CLASS_HANDLER = 'Handler';

    /**
     * {@inheritdoc}
     */
    public function retrieveName(string $messageName): string
    {
        return $messageName.static::SUFFIX_CLASS_HANDLER;
    }
}
