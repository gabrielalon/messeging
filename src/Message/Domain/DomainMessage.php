<?php

namespace N3tt3ch\Messaging\Message\Domain;

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
	 * @param array $payload
	 */
    abstract protected function setPayload(array $payload): void;

    protected function init(): void
    {
        if (null === $this->uuid) {
            $this->uuid = (string) \Ramsey\Uuid\Uuid::uuid4();
        }

        if (null === $this->messageName) {
            $this->messageName = \get_class($this);
        }

        if (null === $this->recordedOn) {
            $this->recordedOn = new \DateTime('now');
        }
    }
	
	/**
	 * @return string
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
	 * @return string
	 */
    public function metadataJSON(): string
    {
        return json_encode($this->metadata());
    }
}
