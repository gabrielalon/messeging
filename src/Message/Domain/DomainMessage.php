<?php

namespace N3ttech\Messaging\Message\Domain;

abstract class DomainMessage implements Message
{
    /** @var string */
    protected $messageName;

    /** @var string */
    protected $uuid;

    /** @var \DateTime */
    protected $recordedOn;

    /** @var array */
    protected $metadata = [];

    /**
     * {@inheritdoc}
     */
    public function messageName(): string
    {
        return $this->messageName;
    }

    /**
     * @return array
     */
    public function metadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array $payload
     */
    abstract protected function setPayload(array $payload): void;

    protected function init(): void
    {
        if (null === $this->uuid) {
            $this->uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }

        if (null === $this->messageName) {
            $this->messageName = \get_class($this);
        }

        if (null === $this->recordedOn) {
            $this->recordedOn = new \DateTime('now');
        }
    }

    /**
     * @return \DateTime
     */
    public function recordedOn(): \DateTime
    {
        return $this->recordedOn;
    }
}
