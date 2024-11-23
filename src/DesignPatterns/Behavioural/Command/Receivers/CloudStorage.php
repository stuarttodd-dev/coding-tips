<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Receivers;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces\FileManager;

class CloudStorage implements FileManager
{
    public function open(string $fileName): ?string
    {
        return "Connecting to cloud storage..." . PHP_EOL . "Opening cloud file: {$fileName}" . PHP_EOL;
    }

    public function save(string $fileName): ?string
    {
        return "Saving file to cloud storage: {$fileName}" . PHP_EOL;
    }

    public function close(string $fileName): ?string
    {
        return "Closing connection for cloud file: {$fileName}" . PHP_EOL;
    }
}
