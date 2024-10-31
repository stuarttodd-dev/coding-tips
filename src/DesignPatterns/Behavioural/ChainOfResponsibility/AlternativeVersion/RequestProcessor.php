<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\AlternativeVersion;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\AuthException;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\PermissionException;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\ValidationException;

class RequestProcessor
{
    /**
     * @param array{
     *     user?: array{
     *         name: string,
     *         roles?: array<int, string>
     *     },
     *     data: string
     * } $request
     *
     * @throws PermissionException
     * @throws ValidationException
     * @throws AuthException
     */
    public function process(array $request): void
    {
        if (!isset($request['user'])) {
            throw new AuthException('User not authenticated.');
        }

        if (!in_array('ADMIN', $request['user']['roles'] ?? [])) {
            throw new PermissionException('User not authorized.');
        }

        if (empty($request['data'])) {
            throw new ValidationException('Invalid data provided.');
        }
    }
}
