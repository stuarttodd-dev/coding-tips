<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems;

class PhaserService
{
    public function fire(): string
    {
        return "Phaser fired!";
    }
}
