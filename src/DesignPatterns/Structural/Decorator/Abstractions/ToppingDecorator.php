<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Abstractions;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Interfaces\Pizza;

abstract class ToppingDecorator implements Pizza
{
    protected float $price;
    protected array $toppings;

    public function __construct(protected Pizza $pizza)
    {
        //
    }

    public function getPrice(): float
    {
        return round($this->pizza->getPrice() + $this->price, 2);
    }

    public function getToppings(): array
    {
        return array_merge($this->pizza->getToppings(), $this->toppings);
    }
}