<?php

namespace N3ttech\Messaging\Snapshot\SnapshotStore;

interface Serializer
{
    /**
     * @param mixed $data
     *
     * @return string
     */
    public function serialize($data);

    /**
     * @param string $data
     */
    public function unserialize($data);
}
