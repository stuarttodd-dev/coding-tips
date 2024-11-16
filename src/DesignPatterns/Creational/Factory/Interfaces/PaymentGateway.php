<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Factory\Interfaces;

interface PaymentGateway
{
    public function pay(float $amount): string;
}
