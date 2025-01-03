<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DSA\LinkedList\SinglyLinkedList\LinkedList;

it('should navigate browser history correctly', function (): void {
    $history = new LinkedList();

    $history->insert('Home');
    $history->insert('Contact');
    $history->insert('About');
    $history->insert('Products');
    $history->insert('FAQ');

    expect($history->display())->toBe('Home -> Contact -> About -> Products -> FAQ');

    expect($history->current())->toBe('FAQ');
    expect($history->goBack())->toBe('Products');
    expect($history->goBack())->toBe('About');
    expect($history->goBack())->toBe('Contact');
    expect($history->goBack())->toBe('Home');

    expect($history->display())->toBe('Home');
    expect($history->goBack())->toBeNull();
});