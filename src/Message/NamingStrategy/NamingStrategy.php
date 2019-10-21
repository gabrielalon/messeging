<?php

namespace N3ttech\Messaging\Message\NamingStrategy;

interface NamingStrategy
{
    /**
     * @param string $messageName
     *
     * @return string
     */
    public function retrieveName(string $messageName): string;
}
