<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Circle implements Shape
{
    public function __construct(private readonly float $radius)
    {
    }

    #[\Override]
    public function getArea(): float
    {
        return M_PI * $this->radius ** 2;
    }
}
