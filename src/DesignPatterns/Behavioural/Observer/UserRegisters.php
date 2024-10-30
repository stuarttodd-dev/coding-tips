<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces\Observer;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces\Subject;

class UserRegisters implements Subject
{
    /**
     * @var array<int, Observer>
     */
    public array $observers = [];

    #[\Override]
    public function attach(Observer $observer): self
    {
        $this->observers[] = $observer;
        return $this;
    }

    #[\Override]
    public function detach(Observer $observer): self
    {
        $this->observers = array_filter($this->observers, fn($class): bool => $class !== $observer);
        return $this;
    }

    #[\Override]
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->handle();
        }
    }
}
