<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces;

interface Observer
{
    public function handle(): void;
}
