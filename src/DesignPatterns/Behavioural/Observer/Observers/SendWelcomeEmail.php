<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Observers;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces\Observer;

class SendWelcomeEmail implements Observer
{
    #[\Override]
    public function handle(): void
    {
        // Logic to send welcome email
    }
}
