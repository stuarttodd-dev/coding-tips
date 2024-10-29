<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Triangle implements Shape
{
    public function __construct(private readonly float $base, private readonly float $height)
    {
    }

    #[\Override]
    public function getArea(): float
    {
        return 0.5 * $this->base * $this->height;
    }
}
