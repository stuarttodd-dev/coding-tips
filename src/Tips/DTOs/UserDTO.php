<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\Tips\DTOs;

class UserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly int $age
    ) {
    }

    /**
     * @param array<string, string> $response
     */
    public static function fromResponse(array $response): self
    {
        return new self(
            name: $response['full_name'],
            email: $response['email_address'],
            age: (int) $response['age']
        );
    }
}
