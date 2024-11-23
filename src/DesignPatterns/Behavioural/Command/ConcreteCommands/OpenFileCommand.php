<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\ConcreteCommands;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces\Command;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces\FileManager;

class OpenFileCommand implements Command
{
    public function __construct(
        private FileManager $fileManager,
        private string $fileName
    ) {
        //
    }

    public function execute(): string
    {
        return $this->fileManager->open($this->fileName);
    }
}
