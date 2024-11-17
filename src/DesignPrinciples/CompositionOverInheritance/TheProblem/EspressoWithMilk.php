<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem;

class EspressoWithMilk extends Espresso
{
    #[\Override]
    public function getDescription(): string
    {
        return parent::getDescription() . " with Milk";
    }

    #[\Override]
    public function getCost(): float
    {
        return parent::getCost() + 0.50;
    }
}
