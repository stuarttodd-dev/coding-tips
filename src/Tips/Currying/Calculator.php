<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\Tips\Currying;

/**
 * Usage:
 * $calculator = new Calculator();
 * $double = $calculator->multiply(2);
 * echo $double(5) . PHP_EOL . $double(8);
 */
class Calculator
{
    public function multiply(float $first): \Closure
    {
        return fn(float $second): float => $first * $second;
    }
}
