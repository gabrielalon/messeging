<?php

namespace N3ttech\Messaging\Aggregate;

interface AggregateId
{
    /**
     * @return string
     */
    public function toString(): string;
}
