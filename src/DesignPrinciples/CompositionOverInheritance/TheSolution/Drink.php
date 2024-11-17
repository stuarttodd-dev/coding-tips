<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution;

use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Interfaces\Ingredient;

class Drink
{
    /** @var Ingredient[] */
    private array $ingredients = [];

    public function __construct(
        private readonly string $description,
        private readonly float $baseCost
    ) {
        //
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    public function getDescription(): string
    {
        $descriptions = array_map(
            fn(Ingredient $ingredient): string => $ingredient->getDescription(),
            $this->ingredients
        );

        return $this->description . ($descriptions === [] ? "" : " with " . implode(", ", $descriptions));
    }

    public function getCost(): float
    {
        $costs = array_reduce(
            $this->ingredients,
            fn($sum, Ingredient $ingredient): float => $sum + $ingredient->getCost(),
            0
        );
        return $this->baseCost + $costs;
    }
}
