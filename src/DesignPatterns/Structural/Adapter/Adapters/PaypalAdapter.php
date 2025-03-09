<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Adapters;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Interface\PaymentGateway;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\VendorFiles\Paypal\Paypal;

class PaypalAdapter implements PaymentGateway
{
    private readonly Paypal $paypal;

    public function __construct()
    {
        $this->paypal = new Paypal();
    }

    #[\Override]
    public function pay(float $amount): string
    {
        return $this->paypal->sendPayment($amount);
    }
}
