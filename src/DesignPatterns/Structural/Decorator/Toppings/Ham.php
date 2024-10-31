<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions\ToppingDecorator;

class Ham extends ToppingDecorator
{
    protected float $price = 1.29;

    protected array $toppings = [
        'Ham'
    ];
}
