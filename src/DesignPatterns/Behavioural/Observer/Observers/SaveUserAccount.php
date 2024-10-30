<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Observers;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces\Observer;

class SaveUserAccount implements Observer
{
    #[\Override]
    public function handle(): void
    {
        // Logic to save a user account
    }
}
