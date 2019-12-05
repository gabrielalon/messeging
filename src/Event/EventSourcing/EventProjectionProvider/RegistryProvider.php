<?php

namespace N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;

use N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;
use N3ttech\Messaging\Message\EventSourcing\EventProjector;

class RegistryProvider implements EventProjectionProvider
{
    /** @var EventProjector[] */
    private $projectors = [];

    /**
     * @param string         $projectorName
     * @param EventProjector $projector
     */
    public function register(string $projectorName, EventProjector $projector): void
    {
        $this->projectors[$projectorName] = $projector;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve(string $projectionName): EventProjector
    {
        if (false === isset($this->projectors[$projectionName])) {
            throw new \InvalidArgumentException(\sprintf('Projector for name %s is not registered.', $projectionName));
        }

        return $this->projectors[$projectionName];
    }
}
