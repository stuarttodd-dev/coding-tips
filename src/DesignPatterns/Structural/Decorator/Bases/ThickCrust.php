<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Bases;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions\BaseComponent;

class ThickCrust extends BaseComponent
{
    protected float $price = 5.99;
    protected array $toppings = [];
}
