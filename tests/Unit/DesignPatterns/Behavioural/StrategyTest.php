<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Circle;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Ellipse;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Hexagon;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Octagon;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Pentagon;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Rectangle;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Square;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Trapezoid;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Triangle;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\AlternativeVersion\Shape;
use InvalidArgumentException;

it('calculates the area of a circle', function (): void {
    $radius = 3;
    $circle = new Circle($radius);
    $expectedArea = M_PI * $radius ** 2;

    expect($circle->getArea())->toBe($expectedArea);
});

it('calculates the area of a rectangle', function (): void {
    $width = 4;
    $height = 5;
    $rectangle = new Rectangle($width, $height);
    $expectedArea = (float)$width * $height;

    expect($rectangle->getArea())->toBe($expectedArea);
});

it('calculates the area of a square', function (): void {
    $side = 4;
    $square = new Square($side);
    $expectedArea = (float)$side ** 2;

    expect($square->getArea())->toBe($expectedArea);
});

it('calculates the area of a triangle', function (): void {
    $base = 6;
    $height = 4;
    $triangle = new Triangle($base, $height);
    $expectedArea = 0.5 * $base * $height;

    expect($triangle->getArea())->toBe($expectedArea);
});

it('calculates the area of a trapezoid', function (): void {
    $base1 = 5;
    $base2 = 7;
    $height = 4;
    $trapezoid = new Trapezoid($base1, $base2, $height);
    $expectedArea = 0.5 * ($base1 + $base2) * $height;

    expect($trapezoid->getArea())->toBe($expectedArea);
});

it('calculates the area of an ellipse', function (): void {
    $semiMajorAxis = 5;
    $semiMinorAxis = 3;
    $ellipse = new Ellipse($semiMajorAxis, $semiMinorAxis);
    $expectedArea = M_PI * $semiMajorAxis * $semiMinorAxis;

    expect($ellipse->getArea())->toBe($expectedArea);
});

it('calculates the area of a hexagon', function (): void {
    $side = 6;
    $hexagon = new Hexagon($side);
    $expectedArea = (3 * sqrt(3) / 2) * $side ** 2;

    expect($hexagon->getArea())->toBe($expectedArea);
});

it('calculates the area of a pentagon', function (): void {
    $side = 4;
    $pentagon = new Pentagon($side);
    $expectedArea = (1 / 4) * sqrt(5 * (5 + 2 * sqrt(5))) * $side ** 2;

    expect($pentagon->getArea())->toBe($expectedArea);
});

it('calculates the area of an octagon', function (): void {
    $side = 5;
    $octagon = new Octagon($side);
    $expectedArea = 2 * (1 + sqrt(2)) * $side ** 2;

    expect($octagon->getArea())->toBe($expectedArea);
});

it('calculates the area of a circle (alternative version)', function (): void {
    $radius = 3;
    $area = Shape::getArea('circle', ['radius' => $radius]);
    $expectedArea = M_PI * $radius ** 2;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of a rectangle (alternative version)', function (): void {
    $width = 4;
    $height = 5;
    $area = Shape::getArea('rectangle', ['width' => $width, 'height' => $height]);
    $expectedArea = (float)$width * $height;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of a square (alternative version)', function (): void {
    $side = 4;
    $area = Shape::getArea('square', ['side' => $side]);
    $expectedArea = (float)$side ** 2;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of a triangle (alternative version)', function (): void {
    $base = 6;
    $height = 4;
    $area = Shape::getArea('triangle', ['base' => $base, 'height' => $height]);
    $expectedArea = 0.5 * $base * $height;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of a trapezoid (alternative version)', function (): void {
    $base1 = 5;
    $base2 = 7;
    $height = 4;
    $area = Shape::getArea('trapezoid', ['base1' => $base1, 'base2' => $base2, 'height' => $height]);
    $expectedArea = 0.5 * ($base1 + $base2) * $height;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of an ellipse (alternative version)', function (): void {
    $semiMajorAxis = 5;
    $semiMinorAxis = 3;
    $area = Shape::getArea('ellipse', ['semiMajorAxis' => $semiMajorAxis, 'semiMinorAxis' => $semiMinorAxis]);
    $expectedArea = M_PI * $semiMajorAxis * $semiMinorAxis;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of a hexagon (alternative version)', function (): void {
    $side = 6;
    $area = Shape::getArea('hexagon', ['side' => $side]);
    $expectedArea = (3 * sqrt(3) / 2) * $side ** 2;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of a pentagon (alternative version)', function (): void {
    $side = 4;
    $area = Shape::getArea('pentagon', ['side' => $side]);
    $expectedArea = (1 / 4) * sqrt(5 * (5 + 2 * sqrt(5))) * $side ** 2;

    expect($area)->toBe($expectedArea);
});

it('calculates the area of an octagon (alternative version)', function (): void {
    $side = 5;
    $area = Shape::getArea('octagon', ['side' => $side]);
    $expectedArea = 2 * (1 + sqrt(2)) * $side ** 2;

    expect($area)->toBe($expectedArea);
});

it('throws an exception for unknown shape type (alternative version)', function (): void {
    expect(fn(): float => Shape::getArea('unknownShape', []))
        ->toThrow(InvalidArgumentException::class, 'Unknown shape type: unknownShape');
});