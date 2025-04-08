<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Devices\Interface;

interface Device
{
    public function turnOn(): string;

    public function mute(): string;
}
