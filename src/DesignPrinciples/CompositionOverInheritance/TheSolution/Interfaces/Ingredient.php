<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Interfaces;

interface Ingredient
{
    public function getDescription(): string;

    public function getCost(): float;
}
