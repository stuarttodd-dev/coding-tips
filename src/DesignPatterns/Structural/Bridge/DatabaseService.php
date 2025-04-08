<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\DatabaseManager;

class DatabaseService extends DatabaseManager
{
    public function connect(): string
    {
        return $this->database->connect();
    }

    public function getUser(int $userId): string
    {
        return $this->database->getUser($userId);
    }
}
