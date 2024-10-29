<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Square implements Shape
{
    public function __construct(private readonly float $side)
    {
    }

    #[\Override]
    public function getArea(): float
    {
        return $this->side ** 2;
    }
}
