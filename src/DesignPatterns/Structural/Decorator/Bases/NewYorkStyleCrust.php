<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Bases;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions\BaseComponent;

class NewYorkStyleCrust extends BaseComponent
{
    protected float $price = 4.49;
    protected array $toppings = [];
}
