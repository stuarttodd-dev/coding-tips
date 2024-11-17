<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem\Coffee;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem\Espresso;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem\EspressoWithMilk;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem\EspressoWithMilkAndSugar;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheProblem\EspressoWithSugar;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Drink;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Interfaces\Ingredient;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Abstractions\AbstractIngredient;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Ingredients\FlavouredSyrup;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Ingredients\Milk;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Ingredients\Sugar;
use HalfShellStudios\CodingTips\DesignPrinciples\CompositionOverInheritance\TheSolution\Ingredients\WhippedCream;

it('returns the correct description and cost for Coffee (bad way)', function () {
    $coffee = new Coffee();

    expect($coffee->getDescription())->toBe('Generic Coffee');
    expect($coffee->getCost())->toBe(2.00);
});

it('returns the correct description and cost for Espresso (bad way)', function () {
    $espresso = new Espresso();

    expect($espresso->getDescription())->toBe('Espresso');
    expect($espresso->getCost())->toBe(2.50);
});

it('returns the correct description and cost for Espresso with Milk (bad way)', function () {
    $espressoWithMilk = new EspressoWithMilk();

    expect($espressoWithMilk->getDescription())->toBe('Espresso with Milk');
    expect($espressoWithMilk->getCost())->toBe(3.00);  // 2.50 + 0.50
});

it('returns the correct description and cost for Espresso with Milk and Sugar (bad way)', function () {
    $espressoWithMilkAndSugar = new EspressoWithMilkAndSugar();

    expect($espressoWithMilkAndSugar->getDescription())->toBe('Espresso with Milk');
    expect($espressoWithMilkAndSugar->getCost())->toBe(3.00);  // 2.50 + 0.50
});

it('returns the correct description and cost for Espresso with Sugar (bad way)', function () {
    $espressoWithSugar = new EspressoWithSugar();

    expect($espressoWithSugar->getDescription())->toBe('Espresso with Milk and Sugar');
    expect($espressoWithSugar->getCost())->toBe(3.20);  // 2.50 + 0.50 + 0.20
});

it('returns the correct description and cost for espresso with milk', function () {
    $espresso = new Drink("Espresso", 2.50);
    $milk = new Milk();

    expect($milk)->toBeInstanceOf(AbstractIngredient::class);
    expect($milk)->toBeInstanceOf(Ingredient::class);

    $espressoWithMilk = (clone $espresso)->addIngredient($milk);

    expect($espressoWithMilk->getDescription())->toBe('Espresso with Milk');
    expect($espressoWithMilk->getCost())->toBe(3.00);  // 2.50 + 0.50
});

it('returns the correct description and cost for americano with milk and sugar', function () {
    $americano = new Drink("Americano", 2.30);
    $milk = new Milk();
    $sugar = new Sugar();

    expect($milk)->toBeInstanceOf(AbstractIngredient::class);
    expect($milk)->toBeInstanceOf(Ingredient::class);
    expect($sugar)->toBeInstanceOf(AbstractIngredient::class);
    expect($sugar)->toBeInstanceOf(Ingredient::class);

    $americanoWithMilkAndSugar = (clone $americano)
        ->addIngredient($milk)
        ->addIngredient($sugar);

    expect($americanoWithMilkAndSugar->getDescription())->toBe('Americano with Milk, Sugar');
    expect($americanoWithMilkAndSugar->getCost())->toBe(3.05);  // 2.30 + 0.50 + 0.25
});

it('returns the correct description and cost for deluxe hot chocolate', function () {
    $hotChocolate = new Drink("Hot Chocolate", 3.50);
    $milk = new Milk();
    $whippedCream = new WhippedCream();
    $caramelSyrup = new FlavouredSyrup("Caramel");
    $vanillaSyrup = new FlavouredSyrup("Vanilla");

    expect($milk)->toBeInstanceOf(AbstractIngredient::class);
    expect($milk)->toBeInstanceOf(Ingredient::class);
    expect($whippedCream)->toBeInstanceOf(AbstractIngredient::class);
    expect($whippedCream)->toBeInstanceOf(Ingredient::class);
    expect($caramelSyrup)->toBeInstanceOf(AbstractIngredient::class);
    expect($caramelSyrup)->toBeInstanceOf(Ingredient::class);
    expect($vanillaSyrup)->toBeInstanceOf(AbstractIngredient::class);
    expect($vanillaSyrup)->toBeInstanceOf(Ingredient::class);

    $deluxeHotChocolate = (clone $hotChocolate)
        ->addIngredient($milk)
        ->addIngredient($whippedCream)
        ->addIngredient($caramelSyrup)
        ->addIngredient($vanillaSyrup);

    expect($deluxeHotChocolate->getDescription())
        ->toBe('Hot Chocolate with Milk, Whipped Cream, Flavoured Syrup Caramel, Flavoured Syrup Vanilla');
    expect($deluxeHotChocolate->getCost())->toBe(5.75);  // 3.50 + 0.50 + 0.85 + 0.45 + 0.45
});

it('returns the correct description and cost for espresso with multiple syrups', function () {
    $espresso = new Drink("Espresso", 2.50);
    $caramelSyrup = new FlavouredSyrup("Caramel");
    $vanillaSyrup = new FlavouredSyrup("Vanilla");

    expect($caramelSyrup)->toBeInstanceOf(AbstractIngredient::class);
    expect($caramelSyrup)->toBeInstanceOf(Ingredient::class);
    expect($vanillaSyrup)->toBeInstanceOf(AbstractIngredient::class);
    expect($vanillaSyrup)->toBeInstanceOf(Ingredient::class);

    $espressoWithSyrups = (clone $espresso)
        ->addIngredient($caramelSyrup)
        ->addIngredient($vanillaSyrup);

    expect($espressoWithSyrups->getDescription())
        ->toBe('Espresso with Flavoured Syrup Caramel, Flavoured Syrup Vanilla');
    expect($espressoWithSyrups->getCost())->toBe(3.40);  // 2.50 + 0.45 + 0.45
});

it('returns the correct description and cost for a basic espresso', function () {
    $espresso = new Drink("Espresso", 2.50);
    $basicEspresso = (clone $espresso);

    expect($basicEspresso->getDescription())->toBe('Espresso');
    expect($basicEspresso->getCost())->toBe(2.50);  // No ingredients, just the base cost
});
