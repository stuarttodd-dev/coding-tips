<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Book;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Document;

interface VisitorInterface
{
    public function visitBook(Book $book): void;

    public function visitDocument(Document $document): void;
}
