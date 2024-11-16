<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory;

use HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\Interfaces\PaymentGateway;
use InvalidArgumentException;

class PaymentGatewayFactory
{
    public function make(string $gatewayType): PaymentGateway
    {
        return match (strtolower($gatewayType)) {
            'paypal' => new PayPalGateway(),
            'stripe' => new StripeGateway(),
            'square' => new SquareGateway(),
            default => throw new InvalidArgumentException('Unsupported gateway type: ' . $gatewayType),
        };
    }
}
