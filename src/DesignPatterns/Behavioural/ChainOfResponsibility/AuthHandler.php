<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Abstractions\AbstractHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\AuthException;

class AuthHandler extends AbstractHandler
{
    /**
     * @throws AuthException
     */
    #[\Override]
    public function handle(array $request): ?string
    {
        if (!isset($request['user'])) {
            throw new AuthException('User not authenticated');
        }

        return parent::handle($request);
    }
}
