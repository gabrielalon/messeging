<?php

namespace N3tt3ch\Messaging\Message\Domain;

interface Message
{
    /**
     * @return string
     */
    public function messageName(): string;
}
