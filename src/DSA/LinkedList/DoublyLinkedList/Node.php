<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DSA\LinkedList\DoublyLinkedList;

class Node
{
    public ?Node $next = null;

    public ?Node $prev = null;

    public function __construct(public string $data)
    {
    }
}
