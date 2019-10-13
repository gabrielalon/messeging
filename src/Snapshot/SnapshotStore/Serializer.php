<?php

namespace N3tt3ch\Messaging\Snapshot\SnapshotStore;

interface Serializer
{
    /**
     * @return string
     */
    public function serialize($data);

    /**
     * @param string $data
     */
    public function unserialize($data);
}
