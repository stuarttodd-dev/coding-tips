<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems;

class PowerService
{
    public function initialise(): string
    {
        return "Power system online and ready.";
    }
}
