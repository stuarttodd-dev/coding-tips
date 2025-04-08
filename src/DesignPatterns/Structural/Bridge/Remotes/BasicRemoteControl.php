<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Remotes;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Devices\Interface\Device;

class BasicRemoteControl
{
    public function __construct(protected Device $device)
    {
        //
    }

    public function turnOn(): string
    {
        return $this->device->turnOn();
    }
}
