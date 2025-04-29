<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components;

class File implements Item
{
    public function __construct(private readonly string $name, private readonly float $size)
    {
        //
    }

    #[\Override]
    public function getSize(): float
    {
        return $this->size;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
