<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems;

class StabiliserService
{
    public function stabilise(): string
    {
        return "Ship stabilised.";
    }
}
