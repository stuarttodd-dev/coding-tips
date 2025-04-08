<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Devices;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Devices\Interface\Device;

class Television implements Device
{
    #[\Override]
    public function turnOn(): string
    {
        return "Turning on the television";
    }

    #[\Override]
    public function mute(): string
    {
        return "Muting the television";
    }
}
