<?php

namespace N3ttech\Messaging\Event\EventSourcing;

use N3ttech\Messaging\Message\EventSourcing\EventProjector;

interface EventProjectionProvider
{
    /**
     * @param string $projectionName
     *
     * @return EventProjector
     */
    public function retrieve(string $projectionName): EventProjector;
}
