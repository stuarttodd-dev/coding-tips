<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge;

interface DatabaseInterface
{
    public function connect(): string;
    public function getUser(int $userId): string;
}
