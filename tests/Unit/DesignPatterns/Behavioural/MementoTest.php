<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Memento\TextEditor;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Memento\History;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Memento\TextMemento;

it('can save and restore text states', function (): void {
    $editor = new TextEditor();
    $history = new History();

    $editor->type("Hello ");
    $history->push($editor->save());

    $editor->type("World!");
    $history->push($editor->save());
    expect($editor->getText())->toBe("Hello World!");

    // Undo last action
    $editor->restore($history->pop());
    expect($editor->getText())->toBe("Hello ");

    // Undo again
    $editor->restore($history->pop());
    expect($editor->getText())->toBe("");
});

it('returns null when popping from empty history', function (): void {
    $history = new History();

    expect($history->pop())->toBeNull();
});

it('can handle multiple undo steps in correct order', function (): void {
    $editor = new TextEditor();
    $history = new History();

    $editor->type("A");
    $history->push($editor->save());

    $editor->type("B");
    $history->push($editor->save());

    $editor->type("C");
    $history->push($editor->save());

    expect($editor->getText())->toBe("ABC");

    // Undo last
    $editor->restore($history->pop());
    expect($editor->getText())->toBe("AB");

    // Undo again
    $editor->restore($history->pop());
    expect($editor->getText())->toBe("A");

    // Undo final
    $editor->restore($history->pop());
    expect($editor->getText())->toBe("");
});

it('allows new saves after undo', function (): void {
    $editor = new TextEditor();
    $history = new History();

    $editor->type("First ");
    $history->push($editor->save());

    $editor->type("Second ");
    $history->push($editor->save());

    expect($editor->getText())->toBe("First Second ");

    // Undo
    $editor->restore($history->pop());
    expect($editor->getText())->toBe("First ");

    // Start new path
    $editor->type("Third!");
    $history->push($editor->save());

    expect($editor->getText())->toBe("First Third!");
});

it('ensures mementos are immutable', function (): void {
    $memento = new TextMemento("Snapshot");

    expect($memento->getText())->toBe("Snapshot");

    // Even if editor changes, old snapshot stays the same
    $editor = new TextEditor();
    $editor->type("Live State");

    expect($memento->getText())->toBe("Snapshot");
});
