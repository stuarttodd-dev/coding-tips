<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Interfaces;

interface Handler
{
    public function setNext(Handler $handler): Handler;

    /**
     * @param array{
     *     user?: array{
     *         name?: string,
     *         roles?: array<int, string>
     *     },
     *     data?: string
     * } $request
     */
    public function handle(array $request): ?string;
}
