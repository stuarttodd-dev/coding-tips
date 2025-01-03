<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DSA\LinkedList\CircularLinkedList;

class LinkedList
{
    public ?Node $head = null;

    public ?Node $tail = null;

    public ?Node $current = null;

    public function insert(string $data): void
    {
        $node = new Node($data);

        if (!$this->head instanceof Node) {
            $this->head = $node;
            $this->tail = $node;
            $this->current = $node;
            $node->next = $node;
            $node->prev = $node;
            return;
        }

        $node->prev = $this->tail;
        $node->next = $this->head;
        if ($this->tail instanceof Node) {
            $this->tail->next = $node;
        }

        $this->head->prev = $node;
        $this->tail = $node;
    }

    public function display(): ?string
    {
        $display = [];

        if (!$this->head instanceof Node) {
            return null;
        }

        $current = $this->head;
        do {
            if ($current instanceof Node) {
                $display[] = $current->data;
                $current = $current->next;
            }
        } while ($current !== $this->head);

        return implode(" <-> ", $display);
    }

    public function current(): ?string
    {
        return $this->current?->data;
    }

    public function forward(): ?string
    {
        if (!$this->current instanceof Node || !$this->current->next instanceof Node) {
            return $this->current->data ?? null;
        }

        $this->current = $this->current->next;

        return $this->current->data;
    }

    public function back(): ?string
    {
        if (!$this->current instanceof Node || !$this->current->prev instanceof Node) {
            return $this->current->data ?? null;
        }

        $this->current = $this->current->prev;

        return $this->current->data;
    }
}
