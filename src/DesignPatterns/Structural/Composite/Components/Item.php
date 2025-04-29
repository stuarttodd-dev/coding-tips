<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components;

interface Item
{
    public function getSize(): float;
    public function find(string $name): ?Item;
    public function list(int $depth = 0): void;
}
