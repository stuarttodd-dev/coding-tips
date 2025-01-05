<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\ObjectPool\Resources;

class DatabaseConnection
{
    public function connect(): void
    {
        echo "Connecting to database...\n";
    }

    public function disconnect(): void
    {
        echo "Disconnecting from database...\n";
    }
}
