<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\VendorFiles\Paypal;

class Paypal
{
    public function sendPayment(float $amount): string
    {
        return $amount . ' sent to paypal';
    }
}
