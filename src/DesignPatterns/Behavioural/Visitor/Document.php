<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces\VisitableInterface;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces\VisitorInterface;

class Document implements VisitableInterface
{
    public function __construct(private readonly int $pages, private readonly string $content = '')
    {
    }

    public function getPageCount(): int
    {
        return $this->pages;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    #[\Override]
    public function accept(VisitorInterface $visitor): void
    {
        $visitor->visitDocument($this);
    }
}
