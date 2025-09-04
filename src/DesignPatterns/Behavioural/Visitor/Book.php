<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces\VisitableInterface;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces\VisitorInterface;

class Book implements VisitableInterface
{
    /**
     * @param Chapter[] $chapters
     */
    public function __construct(private readonly array $chapters = [])
    {
    }

    /** @return Chapter[] */
    public function getChapters(): array
    {
        return $this->chapters;
    }

    #[\Override]
    public function accept(VisitorInterface $visitor): void
    {
        $visitor->visitBook($this);
    }
}
