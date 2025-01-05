<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\ObjectPool\Resources;

class FileHandler
{
    public function open(string $filename, string $mode): void
    {
        // Open file
        dump($filename, $mode);
    }

    public function close(): void
    {
        // Close file
    }
}
