<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components;

class Folder implements Item
{
    /** @var Item[] */
    private array $items = [];

    public function __construct(private readonly string $name)
    {
        //
    }

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    #[\Override]
    public function getSize(): float
    {
        $totalSize = 0;
        foreach ($this->items as $item) {
            $totalSize += $item->getSize();
        }

        return $totalSize;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
