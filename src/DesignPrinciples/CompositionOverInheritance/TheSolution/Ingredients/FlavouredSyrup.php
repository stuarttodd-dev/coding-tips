<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Ingredients;

use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Abstractions\AbstractIngredient;

class FlavouredSyrup extends AbstractIngredient
{
    protected string $description = 'Flavoured Syrup';

    protected float $cost = 0.45;

    public function __construct(string $type)
    {
        $this->description .= " " . $type;
    }
}
