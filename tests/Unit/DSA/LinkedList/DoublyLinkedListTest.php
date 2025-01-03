<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DSA\LinkedList\DoublyLinkedList\LinkedList;

it('can insert and display items in the list', function (): void {
    $list = new LinkedList();

    $list->insert('Page 1');
    $list->insert('Page 2');
    $list->insert('Page 3');

    $result = $list->display();

    expect($result)->toBe('Page 1 <-> Page 2 <-> Page 3');
});

it('can go navigate around and return the correct current value', function (): void {
    $list = new LinkedList();

    $list->insert('Page 1');
    $list->insert('Page 2');
    $list->insert('Page 3');

    $list->forward();
    $list->forward();

    expect($list->current())->toBe('Page 3');

    $list->back();
    expect($list->current())->toBe('Page 2');

    $list->back();
    expect($list->current())->toBe('Page 1');

    $list->forward();
    expect($list->current())->toBe('Page 2');
});

it('returns null when trying to go back with an empty list', function (): void {
    $list = new LinkedList();

    $result = $list->back();

    expect($result)->toBeNull();
});

it('can go forward multiple times', function (): void {
    $list = new LinkedList();

    $list->insert('Page 1');
    $list->insert('Page 2');
    $list->insert('Page 3');

    $list->forward();

    expect($list->current())->toBe('Page 2');

    $list->forward();
    expect($list->current())->toBe('Page 3');
});

it('can handle a single item list', function (): void {
    $list = new LinkedList();

    $list->insert('Page 1');

    $result = $list->display();

    expect($result)->toBe('Page 1');
    expect($list->current())->toBe('Page 1');
    expect($list->back())->toBe('Page 1');
    expect($list->forward())->toBe('Page 1');
});

it('can go back in the correct order', function (): void {
    $list = new LinkedList();

    $list->insert('Page 1');
    $list->insert('Page 2');
    $list->insert('Page 3');

    $list->forward();
    $list->forward();

    $list->back();

    expect($list->current())->toBe('Page 2');

    $list->back();
    expect($list->current())->toBe('Page 1');
});
