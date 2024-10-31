<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions\ToppingDecorator;

class Sweetcorn extends ToppingDecorator
{
    protected float $price = 0.49;

    protected array $toppings = [
        'Sweetcorn'
    ];
}
