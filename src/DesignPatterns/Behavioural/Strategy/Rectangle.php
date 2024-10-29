<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Rectangle implements Shape
{
    public function __construct(private readonly float $width, private readonly float $height)
    {
    }

    #[\Override]
    public function getArea(): float
    {
        return $this->width * $this->height;
    }
}
