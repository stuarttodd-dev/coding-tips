<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory;

use HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\Interfaces\PaymentGateway;

class StripeGateway implements PaymentGateway
{
    #[\Override]
    public function pay(float $amount): string
    {
        return sprintf('Charge %s with Stripe', $amount);
    }
}
