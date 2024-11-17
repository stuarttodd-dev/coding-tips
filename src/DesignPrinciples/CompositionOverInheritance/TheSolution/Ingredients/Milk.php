<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Ingredients;

use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Abstractions\AbstractIngredient;

class Milk extends AbstractIngredient
{
    protected string $description = 'Milk';

    protected float $cost = 0.5;
}
