<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\OriginalCode;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\PhaserService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\PowerService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\StabiliserService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\TargetingService;

class PostgreSQLService
{
    public function connect(): string
    {
        return "Connecting to PostgreSQL database.";
    }

    public function getUser(int $userId): string
    {
        // Imagine this is a raw SQL query
        return "Fetching user from PostgreSQL with ID: {$userId}";
    }
}
