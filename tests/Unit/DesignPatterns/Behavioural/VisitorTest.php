<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Document;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Book;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Chapter;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\PageCountVisitor;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\WordCountVisitor;

beforeEach(function (): void {
    $this->document = new Document(20, 'Hello world from document');
    $this->book = new Book([
        new Chapter(5, 'one two three'),
        new Chapter(7, 'four five six seven'),
        new Chapter(2, 'eight nine')
    ]);
});

it('calculates page count for Document', function (): void {
    $visitor = new PageCountVisitor();
    $this->document->accept($visitor);
    expect($visitor->count)->toBe(20);
});

it('calculates page count for Book', function (): void {
    $visitor = new PageCountVisitor();
    $this->book->accept($visitor);
    expect($visitor->count)->toBe(14);
});

it('calculates word count for Document', function (): void {
    $visitor = new WordCountVisitor();
    $this->document->accept($visitor);
    expect($visitor->count)->toBe(4); // "Hello world from document" = 4 words
});

it('calculates word count for Book', function (): void {
    $visitor = new WordCountVisitor();
    $this->book->accept($visitor);
    expect($visitor->count)->toBe(9); // sum of words in chapters
});
