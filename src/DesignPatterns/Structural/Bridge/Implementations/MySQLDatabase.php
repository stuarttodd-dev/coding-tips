<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Implementations;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\DatabaseInterface;

class MySQLDatabase implements DatabaseInterface
{
    public function connect(): string
    {
        return "Connecting to MySQL database.";
    }

    public function getUser(int $userId): string
    {
        return "Fetching user from MySQL with ID: {$userId}";
    }
}
