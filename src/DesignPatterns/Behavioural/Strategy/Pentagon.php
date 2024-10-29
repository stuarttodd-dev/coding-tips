<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Pentagon implements Shape
{
    public function __construct(private readonly float $side)
    {
    }

    #[\Override]
    public function getArea(): float
    {
        return (1 / 4) * sqrt(5 * (5 + 2 * sqrt(5))) * $this->side ** 2;
    }
}
