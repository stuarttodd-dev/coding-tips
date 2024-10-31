<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Abstractions;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Interfaces\Handler;

abstract class AbstractHandler implements Handler
{
    private ?Handler $nextHandler = null;

    #[\Override]
    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    #[\Override]
    public function handle(array $request): ?string
    {
        if ($this->nextHandler instanceof Handler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}
