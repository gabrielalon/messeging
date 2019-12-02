<?php

namespace N3ttech\Messaging\Snapshot\SnapshotStore;

final class CallbackSerializer implements Serializer
{
    /** callable */
    private $serializeCallback = 'serialize';

    /** callable */
    private $unserializeCallback = 'unserialize';

    /**
     * @param callable|null $serializeCallback
     * @param callable|null $unserializeCallback
     */
    public function __construct($serializeCallback, $unserializeCallback)
    {
        if (null !== $serializeCallback && null !== $unserializeCallback) {
            $this->serializeCallback = $serializeCallback;
            $this->unserializeCallback = $unserializeCallback;
        }
    }

    /**
     * @param array|object $data
     *
     * @return string
     */
    public function serialize($data)
    {
        return \call_user_func($this->serializeCallback, $data);
    }

    /**
     * @param string $serialized
     *
     * @return array|object
     */
    public function unserialize($serialized)
    {
        return \call_user_func($this->unserializeCallback, $serialized);
    }
}
