<?php

namespace N3ttech\Messaging\Event\EventTransporting;

use N3ttech\Messaging\Event\EventRouting\EventRouter;
use N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;
use N3ttech\Messaging\Event\NamingStrategy\EventOnPrefixNamingStrategy;
use N3ttech\Messaging\Message\Transporting\Driver;

class EventTransporterFactory
{
    /** @var EventRouter */
    private $router;

    /** @var EventProjectionProvider */
    private $projectionProvider;

    /**
     * @param EventRouter             $router
     * @param EventProjectionProvider $projectionProvider
     */
    public function __construct(EventRouter $router, EventProjectionProvider $projectionProvider)
    {
        $this->router = $router;
        $this->projectionProvider = $projectionProvider;
    }

    /**
     * @return EventTransporter
     */
    public function createDefault(): EventTransporter
    {
        $namingStrategy = new EventOnPrefixNamingStrategy();
        $driver = new EventInMemoryDriver($this->router, $namingStrategy, $this->projectionProvider);

        return $this->create($driver);
    }

    /**
     * @param Driver $driver
     *
     * @return EventTransporter
     */
    public function create(Driver $driver): EventTransporter
    {
        return new EventTransporter($driver);
    }
}
