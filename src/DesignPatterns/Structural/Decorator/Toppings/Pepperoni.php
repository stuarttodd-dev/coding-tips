<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions\ToppingDecorator;

class Pepperoni extends ToppingDecorator
{
    protected float $price = 1.49;
    protected array $toppings = [
        'Pepperoni'
    ];
}
