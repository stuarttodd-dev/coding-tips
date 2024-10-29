<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Trapezoid implements Shape
{
    public function __construct(
        private readonly float $base1,
        private readonly float $base2,
        private readonly float $height
    ) {
    }

    #[\Override]
    public function getArea(): float
    {
        return 0.5 * ($this->base1 + $this->base2) * $this->height;
    }
}
