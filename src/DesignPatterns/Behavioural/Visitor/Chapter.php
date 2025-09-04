<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor;

class Chapter
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
}
