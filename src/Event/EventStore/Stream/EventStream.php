<?php

namespace N3ttech\Messaging\Event\EventStore\Stream;

class EventStream
{
    /** @var string */
    private $aggregateId;

    /** @var int */
    private $aggregateVersion;

    /** @var string */
    private $eventName;

    /** @var array */
    private $payload;

    /** @var array */
    private $metadata;

    /**
     * @param string $aggregateId
     * @param int    $aggregateVersion
     * @param string $eventName
     * @param array  $payload
     * @param array  $metadata
     */
    public function __construct(
        string $aggregateId,
        int $aggregateVersion,
        string $eventName,
        array $payload,
        array $metadata
    ) {
        $this->aggregateId = $aggregateId;
        $this->aggregateVersion = $aggregateVersion;
        $this->eventName = $eventName;
        $this->payload = $payload;
        $this->metadata = $metadata;
    }

    /**
     * @return string
     */
    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * @return int
     */
    public function getAggregateVersion(): int
    {
        return $this->aggregateVersion;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }
}
