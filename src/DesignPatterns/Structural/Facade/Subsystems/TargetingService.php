<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems;

class TargetingService
{
    public function lock(float $xCoordinate, float $yCoordinate): string
    {
        return sprintf('Target locked at coordinates %s, %s.', $xCoordinate, $yCoordinate);
    }
}
