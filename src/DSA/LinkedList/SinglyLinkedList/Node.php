<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList;

class Node
{
    public ?Node $next = null;

    public function __construct(public string $data)
    {
    }
}
