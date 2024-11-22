<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\FluentInterface\Car;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\FluentInterface\Query;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\FluentInterface\Calculator;

it('performs chained calculations', function (): void {
    $calculator = new Calculator();

    $result = $calculator
        ->add(20)
        ->subtract(5)
        ->multiply(2)
        ->divide(3)
        ->getResult();

    expect($result)->toBe(10.0);
});

it('builds a query using a fluent interface', function (): void {
    $query = new Query();

    $sql = $query
        ->select('*')
        ->from('products')
        ->where('price > 100')
        ->orderBy('name', 'ASC')
        ->getQuery();

    expect($sql)->toBe('SELECT * FROM products WHERE price > 100 ORDER BY name ASC');
});

it('configures a car using a fluent interface', function (): void {
    $car = new Car();

    $configuration = $car
        ->setColor('black')
        ->setEngine('electric')
        ->addFeature('autopilot')
        ->addFeature('wireless charging')
        ->getConfiguration();

    expect($configuration)->toMatchArray([
        'color' => 'black',
        'engine' => 'electric',
        'features' => ['autopilot', 'wireless charging'],
    ]);
});