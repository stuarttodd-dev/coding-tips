<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions\ToppingDecorator;

class Pineapple extends ToppingDecorator
{
    protected float $price = 2.99;

    protected array $toppings = [
        'Pineapple'
    ];
}
