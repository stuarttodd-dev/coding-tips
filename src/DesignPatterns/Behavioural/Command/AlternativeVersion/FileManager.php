<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\AlternativeVersion;

class FileManager
{
    public function __construct(private readonly string $storageType = 'LocalStorage')
    {
        //
    }

    public function open(string $fileName): ?string
    {
        if ($this->storageType === 'LocalStorage') {
            return sprintf('Opening local file: %s%s', $fileName, PHP_EOL);
        }

        if ($this->storageType === 'CloudStorage') {
            return "Connecting to cloud storage...\n" .  sprintf('Opening cloud file: %s%s', $fileName, PHP_EOL);
        }

        return null;
    }

    public function save(string $fileName): ?string
    {
        if ($this->storageType === 'LocalStorage') {
            echo sprintf('Saving data to local file: %s%s', $fileName, PHP_EOL);
        } elseif ($this->storageType === 'CloudStorage') {
            echo sprintf('Saving data to cloud file: %s%s', $fileName, PHP_EOL);
        }

        return null;
    }

    public function close(string $fileName): ?string
    {
        if ($this->storageType === 'LocalStorage') {
            return sprintf('Closing local file: %s%s', $fileName, PHP_EOL);
        }

        if ($this->storageType === 'CloudStorage') {
            return sprintf('Closing connection to cloud storage for file: %s%s', $fileName, PHP_EOL);
        }

        return null;
    }
}
