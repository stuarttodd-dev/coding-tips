<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Memento;

class History
{
    /** @var TextMemento[] */
    private array $mementos = [];

    public function push(TextMemento $memento): void
    {
        $this->mementos[] = $memento;
    }

    public function pop(): ?TextMemento
    {
        if ($this->mementos === []) {
            return null;
        }

        array_pop($this->mementos);

        $previous = end($this->mementos);
        if ($previous === false) {
            return null;
        }

        return $previous;
    }
}
