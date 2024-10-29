<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Octagon implements Shape
{
    public function __construct(private readonly float $side)
    {
    }

    #[\Override]
    public function getArea(): float
    {
        return 2 * (1 + sqrt(2)) * $this->side ** 2;
    }
}
