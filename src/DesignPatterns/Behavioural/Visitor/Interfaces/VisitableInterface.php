<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Visitor\Interfaces;

interface VisitableInterface
{
    public function accept(VisitorInterface $visitor): void;
}
