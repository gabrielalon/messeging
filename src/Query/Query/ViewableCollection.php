<?php

namespace N3ttech\Messaging\Query\Query;

interface ViewableCollection extends \Countable, \ArrayAccess, \Iterator
{
    /**
     * @param Viewable $viewable
     */
    public function add(Viewable $viewable): void;

    /**
     * @return Viewable[]
     */
    public function all(): array;
}
