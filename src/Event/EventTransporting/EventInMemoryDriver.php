<?php

namespace N3ttech\Messaging\Event\EventTransporting;

use N3ttech\Messaging\Event\Event\Event;
use N3ttech\Messaging\Event\EventRouting\EventRouter;
use N3ttech\Messaging\Event\EventSourcing\EventProjectionProvider;
use N3ttech\Messaging\Message\Domain\Message;
use N3ttech\Messaging\Message\NamingStrategy\NamingStrategy;
use N3ttech\Messaging\Message\Transporting\Driver;

final class EventInMemoryDriver implements Driver
{
    /** @var EventRouter */
    private $router;

    /** @var NamingStrategy */
    private $namingStrategy;

    /** @var EventProjectionProvider */
    private $projectionProvider;

    /** @var Event|Message[] */
    private $events = [];

    /**
     * @param EventRouter             $router
     * @param NamingStrategy          $namingStrategy
     * @param EventProjectionProvider $projectionProvider
     */
    public function __construct(
        EventRouter $router,
        NamingStrategy $namingStrategy,
        EventProjectionProvider $projectionProvider
    ) {
        $this->router = $router;
        $this->namingStrategy = $namingStrategy;
        $this->projectionProvider = $projectionProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function publish(Message $event): bool
    {
        // @var Event $event
        $this->events[$event->messageName()] = $event;

        return $this->consume($event->messageName());
    }

    /**
     * {@inheritdoc}
     */
    public function consume(string $eventName): bool
    {
        try {
            $event = $this->retrieve($eventName);
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        $this->release($event->messageName());

        $methodName = $this->namingStrategy->retrieveName($event->messageName());
        foreach ($this->router->map($event->messageName()) as $projectorName) {
            $projector = $this->projectionProvider->retrieve($projectorName);

            $reflection = new \ReflectionMethod($projectorName, $methodName);
            $reflection->invoke($projector, $methodName, $event);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function release(string $key): void
    {
        unset($this->events[$key]);
    }

    /**
     * @param string $key
     *
     * @throws \InvalidArgumentException
     *
     * @return Event|Message
     */
    private function retrieve(string $key): Message
    {
        if (false === isset($this->events[$key])) {
            throw new \InvalidArgumentException(sprintf(
                'Event %s does not exists in memory!',
                $key
            ));
        }

        return $this->events[$key];
    }
}
