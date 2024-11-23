<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Interfaces\Command;

class CommandInvoker
{
    private array $commands = [];

    public function addCommand(Command $command): void
    {
        $this->commands[] = $command;
    }

    public function executeAll(): array
    {
        $output = [];
        foreach ($this->commands as $command) {
            $output[] = $command->execute();
        }

        $this->commands = [];
        return $output;
    }
}
