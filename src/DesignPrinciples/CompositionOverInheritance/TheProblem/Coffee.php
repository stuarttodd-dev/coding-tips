<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem;

class Coffee
{
    public function getDescription(): string
    {
        return "Generic Coffee";
    }

    public function getCost(): float
    {
        return 2.00;
    }
}
