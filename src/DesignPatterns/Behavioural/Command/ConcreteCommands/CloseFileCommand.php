<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\ConcreteCommands;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces\Command;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces\FileManager;

class CloseFileCommand implements Command
{
    public function __construct(
        private readonly FileManager $fileManager,
        private readonly string $fileName
    ) {
        //
    }

    #[\Override]
    public function execute(): ?string
    {
        return $this->fileManager->close($this->fileName);
    }
}