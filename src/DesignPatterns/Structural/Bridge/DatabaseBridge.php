<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge;

class DatabaseBridge implements DatabaseDriver
{
    public function __construct(protected DatabaseDriver $database)
    {
        //
    }

    #[\Override]
    public function connect(): string
    {
        return $this->database->connect();
    }

    #[\Override]
    public function getUser(int $userId): string
    {
        return $this->database->getUser($userId);
    }
}
