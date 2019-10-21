<?php

namespace N3ttech\Messaging\Message\Domain;

interface Message
{
    /**
     * @return string
     */
    public function messageName(): string;
}
