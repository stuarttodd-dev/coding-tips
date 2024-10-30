<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\AlternativeVersion;

class UserRegisters
{
    public function notify(): void
    {
        $this->logActivity();
        $this->saveUserAccount();
        $this->sendWelcomeEmail();
    }

    public function logActivity(): void
    {
        // logic to log activity
    }

    public function saveUserAccount(): void
    {
        // logic to save user account
    }

    public function sendWelcomeEmail(): void
    {
        // logic to send welcome email
    }
}
