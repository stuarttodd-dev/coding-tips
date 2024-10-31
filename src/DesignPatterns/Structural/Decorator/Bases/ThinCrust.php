<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Bases;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions\BaseComponent;

class ThinCrust extends BaseComponent
{
    protected float $price = 3.49;
    protected array $toppings = [];
}
