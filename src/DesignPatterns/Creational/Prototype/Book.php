<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Prototype;

use HalfShellStudios\CodingTips\DesignPatterns\Creational\Prototype\Interfaces\Prototype;

class Book implements Prototype
{
    public function __construct(
        public string $title,
        public string $author
    ) {
        //
    }

    #[\Override]
    public function clone(): Prototype
    {
        return clone $this;
    }
}
