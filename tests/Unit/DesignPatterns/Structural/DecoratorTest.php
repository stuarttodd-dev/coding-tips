<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Interfaces\Pizza;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Bases\NewYorkStyleCrust;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Bases\ThickCrust;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Bases\ThinCrust;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings\Ham;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings\Mushroom;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings\Pepperoni;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings\Pineapple;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\Toppings\Sweetcorn;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\AlternativeVersion\PizzaMaker;

it('Toppings implement the Pizza interface', function (): void {
    expect(new Ham(new ThinCrust()))->toBeInstanceOf(Pizza::class);
    expect(new Mushroom(new ThickCrust()))->toBeInstanceOf(Pizza::class);
    expect(new Pepperoni(new ThinCrust()))->toBeInstanceOf(Pizza::class);
    expect(new Pineapple(new ThickCrust()))->toBeInstanceOf(Pizza::class);
    expect(new Sweetcorn(new NewYorkStyleCrust()))->toBeInstanceOf(Pizza::class);
});

it('Bases implement the Pizza interface', function (): void {
    expect(new ThinCrust())->toBeInstanceOf(Pizza::class);
    expect(new ThickCrust())->toBeInstanceOf(Pizza::class);
    expect(new NewYorkStyleCrust())->toBeInstanceOf(Pizza::class);
});

it('Can make a thin crust pizza with pineapple and ham', function (): void {
    $pizza = new Pineapple(new Ham(new ThinCrust()));
    expect($pizza->getPrice())->toBe(7.77);
    expect($pizza->getToppings())->toBe(['Ham', 'Pineapple']);
});

it('Can make a thin crust pizza with three lots of mushrooms', function (): void {
    $pizza = new Mushroom(new Mushroom(new Mushroom(new ThinCrust())));
    expect($pizza->getPrice())->toBe(6.46);
    expect($pizza->getToppings())->toBe(['Mushrooms', 'Mushrooms', 'Mushrooms']);
});

it('Can make a thin crust pizza with pepperoni, mushrooms and ham', function (): void {
    $pizza = new Pepperoni(new Mushroom(new Ham(new ThinCrust())));
    expect($pizza->getPrice())->toBe(7.26);
    expect($pizza->getToppings())->toBe(['Ham', 'Mushrooms', 'Pepperoni']);
});

it('Can make a thick crust pizza with pepperoni and ham', function (): void {
    $pizza = new Pepperoni(new Ham(new ThickCrust()));
    expect($pizza->getPrice())->toBe(8.77);
    expect($pizza->getToppings())->toBe(['Ham', 'Pepperoni']);
});

it('Can make a thick crust pizza with ham', function (): void {
    $pizza = new Ham(new ThickCrust());
    expect($pizza->getPrice())->toBe(7.28);
    expect($pizza->getToppings())->toBe(['Ham']);
});

it('Can make a thick crust pizza with ham and 5 pineapples', function (): void {
    $pizza = new Ham(new Pineapple(new Pineapple(new Pineapple(new Pineapple(new Pineapple(new ThickCrust()))))));
    expect($pizza->getPrice())->toBe(22.23);
    expect($pizza->getToppings())->toBe(['Pineapple', 'Pineapple', 'Pineapple', 'Pineapple', 'Pineapple', 'Ham']);
});

it('Can make a thick crust pizza with pepperoni, mushrooms, sweetcorn and ham', function (): void {
    $pizza = new Pepperoni(new Mushroom(new Sweetcorn(new Ham(new ThickCrust()))));
    expect($pizza->getPrice())->toBe(10.25);
    expect($pizza->getToppings())->toBe(['Ham', 'Sweetcorn', 'Mushrooms', 'Pepperoni']);
});

it('Can make a new york style pizza with ham, mushrooms, pepperoni, extra mushrooms and sweetcorn', function (): void {
    $pizza = new Ham(new Mushroom(new Pepperoni(new Mushroom(new Sweetcorn(new NewYorkStyleCrust())))));
    expect($pizza->getPrice())->toBe(9.74);
    expect($pizza->getToppings())->toBe(['Sweetcorn', 'Mushrooms', 'Pepperoni', 'Mushrooms', 'Ham']);
});

it('Can make a new york style pizza with ham and mushrooms', function (): void {
    $pizza = new Ham(new Mushroom(new NewYorkStyleCrust()));
    expect($pizza->getPrice())->toBe(6.77);
    expect($pizza->getToppings())->toBe(['Mushrooms', 'Ham']);
});

it('Can make a new york style pizza with mushroom and sweetcorn', function (): void {
    $pizza = new Mushroom(new Sweetcorn(new NewYorkStyleCrust()));
    expect($pizza->getPrice())->toBe(5.97);
    expect($pizza->getToppings())->toBe(['Sweetcorn', 'Mushrooms']);
});

it('can make a thin crust pizza with ham and pineapple (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('Thin', ['Ham', 'Pineapple']);

    expect($result['price'])->toBe(7.77)
        ->and($result['toppings'])->toBe(['Ham', 'Pineapple']);
});

it('can make a new york style pizza with pepperoni and mushrooms (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('NewYorkStyle', ['Pepperoni', 'Mushrooms']);

    expect($result['price'])->toBe(6.97)
        ->and($result['toppings'])->toBe(['Pepperoni', 'Mushrooms']);
});

it('can make a thick crust pizza with sweetcorn (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('Thick', ['Sweetcorn']);

    expect($result['price'])->toBe(6.48)
        ->and($result['toppings'])->toBe(['Sweetcorn']);
});

it('can make a pizza with no toppings (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('Thin', []);

    expect($result['price'])->toBe(3.49)
        ->and($result['toppings'])->toBe([]);
});

it('can make a pizza with multiple same toppings (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('Thick', ['Pineapple', 'Pineapple']);

    expect($result['price'])->toBe(11.97)
        ->and($result['toppings'])->toBe(['Pineapple', 'Pineapple']);
});

it('handles unknown crust gracefully (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('UnknownCrust', ['Ham']);

    expect($result['price'])->toBe(1.29) // Only the price of Ham
    ->and($result['toppings'])->toBe(['Ham']);
});

it('handles unknown topping gracefully (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('Thin', ['UnknownTopping']);

    expect($result['price'])->toBe(3.49) // Only the price of Thin crust
    ->and($result['toppings'])->toBe(['UnknownTopping']);
});

it('handles mixed known and unknown toppings (alternative version)', function () {
    $pizzaMaker = new PizzaMaker();
    $result = $pizzaMaker->makePizza('Thin', ['Ham', 'UnknownTopping', 'Mushrooms']);

    expect($result['price'])->toBe(5.77) // Thin crust + Ham + Mushrooms
    ->and($result['toppings'])->toBe(['Ham', 'UnknownTopping', 'Mushrooms']);
});
