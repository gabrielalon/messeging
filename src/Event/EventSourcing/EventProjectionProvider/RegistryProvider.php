<?php

namespace N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;

use N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;
use N3ttech\Messaging\Message\EventSourcing\EventProjector;

class RegistryProvider implements EventProjectionProvider
{
    /** @var EventProjector[] */
    private $projectors = [];

    /**
     * @param EventProjector $projector
     */
    public function register(EventProjector $projector): void
    {
        $projectorName = get_class($projector);
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
