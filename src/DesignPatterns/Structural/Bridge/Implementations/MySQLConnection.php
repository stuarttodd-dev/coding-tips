<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Implementations;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\DatabaseDriver;

class MySQLConnection implements DatabaseDriver
{
    #[\Override]
    public function connect(): string
    {
        return "Connecting to MySQL database.";
    }

    #[\Override]
    public function getUser(int $userId): string
    {
        return 'Fetching user from MySQL with ID: ' . $userId;
    }
}
