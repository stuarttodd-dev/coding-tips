<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem;

class Espresso extends Coffee
{
    #[\Override]
    public function getDescription(): string
    {
        return "Espresso";
    }

    #[\Override]
    public function getCost(): float
    {
        return 2.50;
    }
}
