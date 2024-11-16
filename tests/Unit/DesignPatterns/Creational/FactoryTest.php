<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\PaymentGatewayFactory;
use HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\Interfaces\PaymentGateway;
use HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\PayPalGateway;
use HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\StripeGateway;
use HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\SquareGateway;
use InvalidArgumentException;

it('creates a PayPal payment gateway', function (): void {
    $factory = new PaymentGatewayFactory();

    $gateway = $factory->make('paypal');

    expect($gateway)->toBeInstanceOf(PayPalGateway::class);
    expect($gateway)->toBeInstanceOf(PaymentGateway::class);
    expect($gateway->pay(100))->toBe('Charge 100 with Paypal');
});

it('creates a Stripe payment gateway', function (): void {
    $factory = new PaymentGatewayFactory();

    $gateway = $factory->make('stripe');

    expect($gateway)->toBeInstanceOf(StripeGateway::class);
    expect($gateway)->toBeInstanceOf(PaymentGateway::class);
    expect($gateway->pay(50))->toBe('Charge 50 with Stripe');
});

it('creates a Square payment gateway', function (): void {
    $factory = new PaymentGatewayFactory();

    $gateway = $factory->make('square');

    expect($gateway)->toBeInstanceOf(SquareGateway::class);
    expect($gateway)->toBeInstanceOf(PaymentGateway::class);
    expect($gateway->pay(75))->toBe('Charge 75 with Square');
});

it('throws an exception for an unsupported payment gateway', function (): void {
    $factory = new PaymentGatewayFactory();

    $factory->make('unsupported');
})->throws(InvalidArgumentException::class, 'Unsupported gateway type: unsupported');
