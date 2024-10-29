<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\AlternativeVersion;

use InvalidArgumentException;

class Shape
{
    /**
     * @param array<string, int> $parameters
     */
    public static function getArea(string $shapeType, array $parameters): float
    {
        return match ($shapeType) {
            'circle' => M_PI * ($parameters['radius'] ** 2),
            'rectangle' => $parameters['width'] * $parameters['height'],
            'square' => $parameters['side'] ** 2,
            'triangle' => 0.5 * $parameters['base'] * $parameters['height'],
            'trapezoid' => 0.5 * ($parameters['base1'] + $parameters['base2']) * $parameters['height'],
            'ellipse' => M_PI * $parameters['semiMajorAxis'] * $parameters['semiMinorAxis'],
            'hexagon' => (3 * sqrt(3) / 2) * ($parameters['side'] ** 2),
            'pentagon' => (1 / 4) * sqrt(5 * (5 + 2 * sqrt(5))) * ($parameters['side'] ** 2),
            'octagon' => 2 * (1 + sqrt(2)) * ($parameters['side'] ** 2),
            default => throw new InvalidArgumentException('Unknown shape type: ' . $shapeType),
        };
    }
}
