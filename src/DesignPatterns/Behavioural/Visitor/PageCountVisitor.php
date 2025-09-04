<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces\VisitorInterface;

class PageCountVisitor implements VisitorInterface
{
    public int $count = 0;

    #[\Override]
    public function visitBook(Book $book): void
    {
        $this->count = 0;
        foreach ($book->getChapters() as $chapter) {
            $this->count += $chapter->getPageCount();
        }
    }

    #[\Override]
    public function visitDocument(Document $document): void
    {
        $this->count = $document->getPageCount();
    }
}
