<?php

declare(strict_types=1);


use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\PaymentService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Adapters\StripeAdapter;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Adapters\PaypalAdapter;

it('can process a payment using StripeAdapter', function (): void {
    $adapter = new StripeAdapter();
    $service = new PaymentService($adapter);

    $response = $service->pay(100.00);

    expect($response)->toBe('100 sent to stripe');
});

it('can process a payment using PaypalAdapter', function (): void {
    $adapter = new PaypalAdapter();
    $service = new PaymentService($adapter);

    $response = $service->pay(100.00);

    expect($response)->toBe('100 sent to paypal');
});