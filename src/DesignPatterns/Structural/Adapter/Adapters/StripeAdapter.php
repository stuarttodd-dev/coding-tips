<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Adapters;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Interface\PaymentGateway;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\VendorFiles\Stripe\Stripe;

class StripeAdapter implements PaymentGateway
{
    private readonly Stripe $stripe;

    public function __construct()
    {
        $this->stripe = new Stripe();
    }

    #[\Override]
    public function pay(float $amount): string
    {
        return $this->stripe->createCharge($amount);
    }
}
