<?php

use HalfShellStudios\CodingTips\Tips\Currying\Calculator;

it('returns a closure that multiplies by the first number', function (): void {
    $calculator = new Calculator();

    $double = $calculator->multiply(2);

    expect($double(5))->toBe(10.0)
        ->and($double(8))->toBe(16.0);
});

it('returns a closure that multiplies by a different number', function (): void {
    $calculator = new Calculator();

    $triple = $calculator->multiply(3);

    expect($triple(4))->toBe(12.0)
        ->and($triple(10))->toBe(30.0);
});

it('allows multiplying with floating-point numbers', function (): void {
    $calculator = new Calculator();

    $half = $calculator->multiply(0.5);

    expect($half(6))->toBe(3.0)
        ->and($half(8))->toBe(4.0);
});

it('handles multiplying by zero correctly', function (): void {
    $calculator = new Calculator();

    $multiplyByZero = $calculator->multiply(0);

    expect($multiplyByZero(5))->toBe(0.0)
        ->and($multiplyByZero(10))->toBe(0.0);
});
