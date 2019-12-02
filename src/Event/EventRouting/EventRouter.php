<?php

namespace N3ttech\Messaging\Event\EventRouting;

final class EventRouter implements \N3ttech\Messaging\Message\Routing\EventRouter
{
    /** @var string[][] */
    private $map = [];

    /**
     * @param string[][] $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * {@inheritdoc}
     */
    public function map(string $eventName): array
    {
        if (false === isset($this->map[$eventName])) {
            throw new \InvalidArgumentException(sprintf('Given event name %s is not registered!', $eventName));
        }

        return $this->map[$eventName];
    }
}
