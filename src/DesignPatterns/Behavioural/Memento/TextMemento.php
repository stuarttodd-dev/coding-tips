<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Memento;

class TextMemento
{
    public function __construct(private readonly string $text)
    {
        //
    }

    public function getText(): string
    {
        return $this->text;
    }
}
