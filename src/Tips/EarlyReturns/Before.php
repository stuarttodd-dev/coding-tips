<?php

namespace HalfShellStudios\CodingTips\Tips\EarlyReturns;

class Before
{
    /**
     * @param array<string, int|string|null> $user
     */
    public function isValid(array $user): bool
    {
        if ($user['age'] > 18) {
            if (!isset($user['email'])) {
                return false;
            }

            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            return isset($user['name']) && ($user['name'] !== 0 && ($user['name'] !== '' && $user['name'] !== '0'));
        }

        return false;
    }
}
