<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Abstractions;

use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Interfaces\Ingredient;

abstract class AbstractIngredient implements Ingredient
{
    protected string $description;

    protected float $cost;

    #[\Override]
    public function getDescription(): string
    {
        return $this->description;
    }

    #[\Override]
    public function getCost(): float
    {
        return $this->cost;
    }
}
