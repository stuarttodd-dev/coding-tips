<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces;

interface Subject
{
    public function attach(Observer $observer): self;

    public function detach(Observer $observer): self;

    public function notify(): void;
}
