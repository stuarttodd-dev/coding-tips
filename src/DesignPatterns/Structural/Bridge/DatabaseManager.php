<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\DatabaseInterface;

abstract class DatabaseManager
{
    public function __construct(protected DatabaseInterface $database)
    {
        //
    }

    abstract public function connect(): string;
    abstract public function getUser(int $userId): string;
}
