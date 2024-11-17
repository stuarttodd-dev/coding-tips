<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Ingredients;

use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Abstractions\AbstractIngredient;

class WhippedCream extends AbstractIngredient
{
    protected string $description = 'Whipped Cream';

    protected float $cost = 0.85;
}
