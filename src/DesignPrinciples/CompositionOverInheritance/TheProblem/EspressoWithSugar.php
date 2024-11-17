<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem;

class EspressoWithSugar extends EspressoWithMilk
{
    #[\Override]
    public function getDescription(): string
    {
        return parent::getDescription() . " and Sugar";
    }

    #[\Override]
    public function getCost(): float
    {
        return parent::getCost() + 0.20;
    }
}
