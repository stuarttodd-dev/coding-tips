<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Prototype\Interfaces;

interface Prototype
{
    public function clone(): Prototype;
}
