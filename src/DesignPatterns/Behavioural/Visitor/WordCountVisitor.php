<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces\VisitorInterface;

class WordCountVisitor implements VisitorInterface
{
    public int $count = 0;

    #[\Override]
    public function visitBook(Book $book): void
    {
        $this->count = 0;
        foreach ($book->getChapters() as $chapter) {
            $this->count += str_word_count($chapter->getContent());
        }
    }

    #[\Override]
    public function visitDocument(Document $document): void
    {
        $this->count = str_word_count($document->getContent());
    }
}
