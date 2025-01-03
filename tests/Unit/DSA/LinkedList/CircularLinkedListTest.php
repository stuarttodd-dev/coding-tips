<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DSA\LinkedList\CircularLinkedList\LinkedList;

it('can insert elements into the circular linked list', function (): void {
    $list = new LinkedList();

    $list->insert("A");
    $list->insert("B");
    $list->insert("C");

    expect($list->display())->toBe("A <-> B <-> C");
});

it('can navigate forward through the circular list', function (): void {
    $list = new LinkedList();

    $list->insert("A");
    $list->insert("B");
    $list->insert("C");

    expect($list->current())->toBe("A");
    expect($list->forward())->toBe("B");
    expect($list->forward())->toBe("C");
    expect($list->forward())->toBe("A");
    expect($list->back())->toBe("C");
});

it('can navigate backward through the circular list', function (): void {
    $list = new LinkedList();

    $list->insert("A");
    $list->insert("B");
    $list->insert("C");

    expect($list->current())->toBe("A");
    expect($list->back())->toBe("C");
    expect($list->back())->toBe("B");
    expect($list->back())->toBe("A");
});

it('returns null if the list is empty', function (): void {
    $list = new LinkedList();

    expect($list->display())->toBeNull();
    expect($list->current())->toBeNull();
    expect($list->forward())->toBeNull();
    expect($list->back())->toBeNull();
});

it('can correctly handle circular navigation on an empty list', function (): void {
    $list = new LinkedList();
    $list->insert("A");

    // Only one node
    expect($list->current())->toBe("A");
    expect($list->forward())->toBe("A"); // Circular navigation
    expect($list->back())->toBe("A"); // Circular navigation
});

it('can display a single node correctly', function (): void {
    $list = new LinkedList();
    $list->insert("A");

    expect($list->display())->toBe("A");
});

it('can handle multiple insertions and circular navigation', function (): void {
    $list = new LinkedList();
    $list->insert("A");
    $list->insert("B");
    $list->insert("C");
    $list->insert("D");

    // Traverse forward
    expect($list->forward())->toBe("B");
    expect($list->forward())->toBe("C");
    expect($list->forward())->toBe("D");
    expect($list->forward())->toBe("A"); // Circular navigation

    // Traverse backward
    expect($list->back())->toBe("D");
    expect($list->back())->toBe("C");
    expect($list->back())->toBe("B");
    expect($list->back())->toBe("A"); // Circular navigation
});
