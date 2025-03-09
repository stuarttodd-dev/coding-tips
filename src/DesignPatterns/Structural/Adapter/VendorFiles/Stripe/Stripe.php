<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\VendorFiles\Stripe;

class Stripe
{
    public function createCharge(float $amount): string
    {
        return $amount . ' sent to stripe';
    }
}
