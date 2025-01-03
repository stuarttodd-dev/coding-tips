<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList;

class LinkedList
{
    public ?Node $head = null;

    public function insert(string $data): void
    {
        $node = new Node($data);

        if (!$this->head instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node) {
            $this->head = $node;
            return;
        }

        $current = $this->head;
        while ($current->next instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node) {
            $current = $current->next;
        }

        $current->next = $node;
    }

    public function display(): string
    {
        $display = [];

        $current = $this->head;
        while ($current instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node) {
            $display[] = $current->data;
            $current = $current->next;
        }

        return implode(" -> ", $display);
    }

    public function current(): ?string
    {
        if (!$this->head instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node) {
            return null;
        }

        $current = $this->head;
        while ($current->next instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node) {
            $current = $current->next;
        }

        return $current->data;
    }

    public function goBack(): ?string
    {
        if (
            !$this->head instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node ||
            !$this->head->next instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node
        ) {
            return null;
        }

        $current = $this->head;
        $previous = null;

        while ($current->next instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node) {
            $previous = $current;
            $current = $current->next;
        }

        if ($previous instanceof \HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\Node) {
            $previous->next = null;
        }

        return $previous->data ?? null;
    }
}
