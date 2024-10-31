<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Interfaces\Pizza;

abstract class BaseComponent implements Pizza
{
    protected float $price;

    /** @var array<string> */
    protected array $toppings;

    #[\Override]
    public function getPrice(): float
    {
        return round($this->price, 2);
    }

    #[\Override]
    public function getToppings(): array
    {
        return $this->toppings;
    }
}
