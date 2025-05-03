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

    #[\Override]
    public function find(string $name): ?Item
    {
        if ($this->name === $name) {
            return $this;
        }

        foreach ($this->items as $item) {
            $found = $item->find($name);
            if ($found !== null) {
                return $found;
            }
        }

        return null;
    }

    #[\Override]
    public function list(int $depth = 0): void
    {
        echo str_repeat("  ", $depth) . "+ " . $this->name . " (" . $this->getSize() . " KB)\n";
        foreach ($this->items as $item) {
            $item->list($depth + 1);
        }
    }
}
