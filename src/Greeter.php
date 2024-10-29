<?php

declare(strict_types=1);

namespace HalfShellStudios\PackageSample;

class Greeter
{
    public function sayHello(): string
    {
        return 'Well, hello there!';
    }

    public function sayGoodbye(): string
    {
        return 'Errr... Goodbye!';
    }

    public function greet(): string
    {
        return $this->sayHello() . ' ' . $this->sayGoodbye();
    }
}
