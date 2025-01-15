<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\Tips\DTOs;

class SimpleUserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly int $age
    ) {
    }
}
