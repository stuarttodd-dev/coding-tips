<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Interfaces;

interface Pizza
{
    public function getPrice(): float;

    /** @return array<string> */
    public function getToppings(): array;
}
