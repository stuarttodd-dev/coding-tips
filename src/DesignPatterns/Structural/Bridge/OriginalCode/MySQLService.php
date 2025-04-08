<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\OriginalCode;

class MySQLService
{
    public function connect(): string
    {
        return "Connecting to MySQL database.";
    }

    public function getUser(int $userId): string
    {
        // Imagine this is a raw SQL query
        return "Fetching user from MySQL with ID: {$userId}";
    }
}
