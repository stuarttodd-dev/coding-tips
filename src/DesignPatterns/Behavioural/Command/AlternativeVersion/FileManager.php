<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\AlternativeVersion;

class FileManager
{
    public function __construct(private string $storageType = 'LocalStorage')
    {
        //
    }

    public function open(string $fileName): ?string
    {
        if ($this->storageType === 'LocalStorage') {
            return "Opening local file: {$fileName}\n";
        } elseif ($this->storageType === 'CloudStorage') {
            return "Connecting to cloud storage...\n" .  "Opening cloud file: {$fileName}\n";
        }
        return null;
    }

    public function save(string $fileName): ?string
    {
        if ($this->storageType === 'LocalStorage') {
            echo "Saving data to local file: {$fileName}\n";
        } elseif ($this->storageType === 'CloudStorage') {
            echo "Saving data to cloud file: {$fileName}\n";
        }
        return null;
    }

    public function close(string $fileName): ?string
    {
        if ($this->storageType === 'LocalStorage') {
            return "Closing local file: {$fileName}\n";
        } elseif ($this->storageType === 'CloudStorage') {
            return "Closing connection to cloud storage for file: {$fileName}\n";
        }
        return null;
    }
}
