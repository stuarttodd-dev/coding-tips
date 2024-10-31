<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Abstractions\AbstractHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\ValidationException;

class ValidationHandler extends AbstractHandler
{
    /**
     * @throws ValidationException
     */
    #[\Override]
    public function handle(array $request): ?string
    {
        if (empty($request['data'])) {
            throw new ValidationException('Request data is invalid.');
        }

        return parent::handle($request);
    }
}
