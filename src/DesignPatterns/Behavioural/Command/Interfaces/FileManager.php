<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces;

interface FileManager
{
    public function open(string $fileName): ?string;

    public function save(string $fileName): ?string;

    public function close(string $fileName): ?string;
}
