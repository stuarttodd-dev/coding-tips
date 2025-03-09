<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Interface\PaymentGateway;

class PaymentService
{
    public function __construct(private readonly PaymentGateway $gateway)
    {
        //
    }

    public function pay(float $amount): string
    {
        return $this->gateway->pay($amount);
    }
}
