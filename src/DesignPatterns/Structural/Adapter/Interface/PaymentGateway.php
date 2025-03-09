<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Adapter\Interface;

interface PaymentGateway
{
    public function pay(float $amount): string;
}
