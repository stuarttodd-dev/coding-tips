<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Abstractions\AbstractHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\PermissionException;

class PermissionsHandler extends AbstractHandler
{
    /**
     * @throws PermissionException
     */
    #[\Override]
    public function handle(array $request): ?string
    {
        $permissions = $request['user']['roles'] ?? [];

        if (!in_array('ADMIN', $permissions)) {
            throw new PermissionException('User not authorised.');
        }

        return parent::handle($request);
    }
}
