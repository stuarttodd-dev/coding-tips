<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Remotes;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Remotes\BasicRemoteControl;

class AdvancedRemoteControl extends BasicRemoteControl
{
    public function mute(): string
    {
        return $this->device->mute();
    }
}
