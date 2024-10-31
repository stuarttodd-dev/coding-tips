<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Interfaces;

interface Pizza
{
    public function getPrice(): float;
    public function getToppings(): array;
}
