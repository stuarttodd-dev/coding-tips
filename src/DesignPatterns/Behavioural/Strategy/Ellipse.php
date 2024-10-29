<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape;

class Ellipse implements Shape
{
    public function __construct(private readonly float $semiMajorAxis, private readonly float $semiMinorAxis)
    {
    }

    #[\Override]
    public function getArea(): float
    {
        return M_PI * $this->semiMajorAxis * $this->semiMinorAxis;
    }
}
