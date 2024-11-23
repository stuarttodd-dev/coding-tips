<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Receivers;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces\FileManager;

class LocalStorage implements FileManager
{
    #[\Override]
    public function open(string $fileName): ?string
    {
        return 'Opening local file: ' . $fileName . PHP_EOL;
    }

    #[\Override]
    public function save(string $fileName): ?string
    {
        return 'Saving local file: ' . $fileName . PHP_EOL;
    }

    #[\Override]
    public function close(string $fileName): ?string
    {
        return 'Closing local file: ' . $fileName . PHP_EOL;
    }
}
