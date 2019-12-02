<?php

namespace N3ttech\Messaging\Snapshot\Snapshot;

use N3ttech\Messaging\Aggregate\AggregateRoot;

class Snapshot
{
    /** @var AggregateRoot */
    private $aggregateRoot;

    /** @var int */
    private $lastVersion;

    /** @var \DateTime */
    private $createdAt;

    /**
     * @param AggregateRoot $aggregateRoot
     * @param int           $lastVersion
     * @param \DateTime     $createdAt
     */
    public function __construct(
        AggregateRoot $aggregateRoot,
        int $lastVersion,
        \DateTime $createdAt
    ) {
        $this->aggregateRoot = $aggregateRoot;
        $this->lastVersion = $lastVersion;
        $this->createdAt = $createdAt;
    }

    /**
     * @return AggregateRoot|null
     */
    public function getAggregateRoot(): ?AggregateRoot
    {
        return $this->aggregateRoot;
    }

    /**
     * @return int
     */
    public function getLastVersion(): int
    {
        return $this->lastVersion;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
