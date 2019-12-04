<?php

namespace N3ttech\Messaging\Event\EventStore;

interface Serializer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function encode(array $data): string;

    /**
     * @param string $json
     *
     * @return array
     */
    public function decode(string $json): array;
}
