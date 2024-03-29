<?php

namespace N3ttech\Messaging\Event\EventRouting;

class EventRouterFactory
{
    /**
     * @param string $path
     * @param string $pattern
     *
     * @return EventRouter
     */
    public function fromDirectory(string $path, string $pattern = '*.php'): EventRouter
    {
        $map = [];
        $pathPattern = rtrim($path, \DIRECTORY_SEPARATOR).\DIRECTORY_SEPARATOR;

        $iterator = new \GlobIterator($pathPattern.$pattern);
        $iterator->rewind();
        while (true === $iterator->valid()) {
            /** @var string[] $tmp */
            $tmp = include $iterator->current();
            $map = array_merge($map, $tmp);

            $iterator->next();
        }

        return $this->fromArray($map);
    }

    /**
     * @param array $map
     *
     * @return EventRouter
     */
    public function fromArray(array $map): EventRouter
    {
        return EventRouter::fromArray($map);
    }
}
