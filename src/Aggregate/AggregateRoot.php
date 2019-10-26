<?php

namespace N3ttech\Messaging\Aggregate;

use N3ttech\Messaging\Aggregate\EventBridge\AggregateChanged;
use N3ttech\Valuing\Identity\AggregateId;

abstract class AggregateRoot
{
    /** @var int */
    protected $version = 0;

    /** @var AggregateId */
    protected $aggregateId;

    /** @var AggregateChanged[] */
    protected $recordedEvents = [];

    /**
     * @param AggregateId $aggregateId
     */
    public function setAggregateId(AggregateId $aggregateId): void
    {
        $this->aggregateId = $aggregateId;
    }

    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return $this->aggregateId->toString();
    }

    /**
     * @return AggregateChanged[]
     */
    protected function popRecordedEvents(): array
    {
        $pendingEvents = $this->recordedEvents;

        $this->recordedEvents = [];

        return $pendingEvents;
    }

    /**
     * @param AggregateChanged $event
     */
    protected function recordThat(AggregateChanged $event): void
    {
        ++$this->version;

        $this->recordedEvents[] = $event->withVersion($this->version);

        $this->apply($event);
    }

    /**
     * @param \Iterator $historyEvents
     *
     * @return AggregateRoot
     */
    protected static function reconstituteFromHistory(\Iterator $historyEvents): self
    {
        $instance = new static();
        $instance->replay($historyEvents);

        return $instance;
    }

    /**
     * @param \Iterator $historyEvents
     */
    protected function replay(\Iterator $historyEvents): void
    {
        foreach ($historyEvents as $pastEvent) {
            // @var AggregateChanged $pastEvent
            $this->version = $pastEvent->version();

            $this->apply($pastEvent);
        }
    }

    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        $event->populate($this);
    }
}
