<?php

declare(strict_types=1);

namespace HalfShellStudios\DesignPatterns\Behavioural\Strategy\Context;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape as ShapeInterface;

class Shape
{
    public function __construct(private readonly ShapeInterface $shape)
    {
    }

    public function getArea(): float
    {
        return $this->shape->getArea();
    }
}
